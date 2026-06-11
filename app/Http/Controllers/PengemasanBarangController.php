<?php

namespace App\Http\Controllers;

use App\Models\PengemasanBarang;
use App\Models\PermintaanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PengemasanBarangController extends Controller
{
    // Daftar email yang diizinkan akses tambah/edit/hapus
    private $allowedEmails = [
    'pengemasan@gudang.com', 
    'manager@gudang.com'
];

    private function isAuthorized()
    {
        return in_array(Auth::user()->email, $this->allowedEmails);
    }
   public function index(Request $request)
{
    $query = PengemasanBarang::with('permintaan')->latest();

    if ($request->has('search') && $request->search) {
        $search = $request->search;
        $query->whereHas('permintaan.penyimpanan.penerimaan.barang', function ($q) use ($search) {
            $q->where('nama_barang', 'like', '%' . $search . '%')
              ->orWhere('kode_barang', 'like', '%' . $search . '%')
              ->orWhere('status_pengemasan', 'like', '%' . $search . '%')
              ->orWhere('tujuan_pengiriman', 'like', '%' . $search . '%');
        });
    }

    $pengemasan = $query->get();
// Flash message hanya ditambahkan jika ada parameter search
    if ($request->has('search')) {
        if($pengemasan->isEmpty()){
            session()->flash('search_not_found', $search);
        } else {
            session()->flash('search_success', $search);
        }
    }
    return view('pengemasan_barang.index', compact('pengemasan'));
}


    /**
     * Form tambah pengemasan.
     */
   // create() di PengemasanBarangController
public function create()
{
    // Ambil semua permintaan yang belum dikemas
    $usedPermintaanIds = PengemasanBarang::pluck('permintaan_id')->toArray();

    $permintaan = PermintaanBarang::with('penyimpanan.penerimaan.barang')
        ->whereNotIn('id', $usedPermintaanIds)
        ->get();

    return view('pengemasan_barang.create', compact('permintaan'));
}



    public function store(Request $request)
{
    $request->validate([
        'permintaan_id'          => 'required|exists:permintaan_barang,id',
        'jumlah_barang_dikemas'  => 'required|integer|min:1',
        'tujuan_pengiriman'     => ['required','regex:/^[a-zA-Z0-9\s]*$/'],
        'tanggal_pengemasan'     => 'required|date',
    ], [
        'permintaan_id.required'         => 'Permintaan barang harus dipilih.',
        'permintaan_id.exists'           => 'Permintaan barang tidak ditemukan.',
        'jumlah_barang_dikemas.required' => 'Jumlah barang yang dikemas wajib diisi.',
        'jumlah_barang_dikemas.integer'  => 'Jumlah harus berupa angka.',
        'jumlah_barang_dikemas.min'      => 'Jumlah minimal adalah 1.',
        'tujuan_pengiriman.regex' => 'Tujuan pengiriman tidak boleh mengandung simbol.',
        'tujuan_pengiriman.required'     => 'Tujuan pengiriman wajib diisi.',
        'tujuan_pengiriman.string'       => 'Tujuan pengiriman harus berupa teks.',
        'tujuan_pengiriman.max'          => 'Tujuan pengiriman maksimal 255 karakter.',
        'tanggal_pengemasan.required'    => 'Tanggal pengemasan wajib diisi.',
        'tanggal_pengemasan.date'        => 'Format tanggal pengemasan tidak valid.',

    ]);

    // Ambil permintaan terkait untuk validasi jumlah
    $permintaan = PermintaanBarang::findOrFail($request->permintaan_id);

    // Validasi jumlah tidak melebihi permintaan
    if ((int)$request->jumlah_barang_dikemas > (int)$permintaan->jumlah_barang_diminta) {
        return back()
            ->withErrors(['jumlah_barang_dikemas' => 'Jumlah dikemas tidak boleh melebihi jumlah diminta ('.$permintaan->jumlah_barang_diminta.').'])
            ->withInput();
    }

    DB::transaction(function () use ($request, $permintaan) {
        PengemasanBarang::create([
            'permintaan_id'         => $request->permintaan_id,
            'jumlah_barang_dikemas' => $request->jumlah_barang_dikemas,
            'tujuan_pengiriman'     => $request->tujuan_pengiriman,
            'tanggal_pengemasan'    => $request->tanggal_pengemasan,
            'status_pengemasan'     => $request->status_pengemasan ?? 'sedang dikemas',
        ]);

        if ($permintaan->status_permintaan !== 'dikemas') {
            $permintaan->status_permintaan = 'dikemas';
            $permintaan->save();
        }
    });

    return redirect()->route('pengemasan_barang.index')->with('success', 'Data pengemasan berhasil ditambahkan.');
}

    /**
     * Form edit pengemasan.
     */
    public function edit(PengemasanBarang $pengemasan_barang)
    {
        // Ambil permintaan utk dropdown (jarang diganti, tapi tetap disediakan)
        $permintaan = PermintaanBarang::all();
        return view('pengemasan_barang.edit', [
            'pengemasan' => $pengemasan_barang,
            'permintaan' => $permintaan,
        ]);
    }

    /**
     * Update pengemasan.
     */
    public function update(Request $request, PengemasanBarang $pengemasan_barang)
    {
        $request->validate([
            'permintaan_id'          => 'required|exists:permintaan_barang,id',
            'jumlah_barang_dikemas'  => 'required|integer|min:1',
            'tujuan_pengiriman'      => 'required|string|max:255',
            'tanggal_pengemasan'     => 'required|date',
            'status_pengemasan'      => 'required|string|max:50',
        ]);

        // Validasi jumlah vs permintaan
        $permintaan = PermintaanBarang::findOrFail($request->permintaan_id);
        if ((int)$request->jumlah_barang_dikemas > (int)$permintaan->jumlah_barang_diminta) {
            return back()
                ->withErrors(['jumlah_barang_dikemas' => 'Jumlah dikemas tidak boleh melebihi jumlah diminta ('.$permintaan->jumlah_barang_diminta.').'])
                ->withInput();
        }

        $pengemasan_barang->update([
            'permintaan_id'         => $request->permintaan_id,
            'jumlah_barang_dikemas' => $request->jumlah_barang_dikemas,
            'tujuan_pengiriman'     => $request->tujuan_pengiriman,
            'tanggal_pengemasan'    => $request->tanggal_pengemasan,
            'status_pengemasan'     => $request->status_pengemasan,
        ]);

        return redirect()->route('pengemasan_barang.index')->with('success', 'Data pengemasan berhasil diperbarui.');
    }

    /**
     * Hapus pengemasan.
     */
    public function destroy(PengemasanBarang $pengemasan_barang)
    {
        $pengemasan_barang->delete();
        return redirect()->route('pengemasan_barang.index')->with('success', 'Data pengemasan berhasil dihapus.');
    }
}
