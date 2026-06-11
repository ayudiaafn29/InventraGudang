<?php

namespace App\Http\Controllers;

use App\Models\PenerimaanBarang;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaanBarangController extends Controller
{
    // Daftar email yang diizinkan akses tambah/edit/hapus
    private $allowedEmails = [
    'penerimaan@gudang.com',
    'manager@gudang.com'
];

    private function isAuthorized()
    {
        return in_array(Auth::user()->email, $this->allowedEmails);
    }

 public function index(Request $request)
{
    $query = PenerimaanBarang::with(['barang', 'supplier']);

    if ($search = $request->search) {
        $query->whereHas('barang', function ($q) use ($search) {
            $q->where('nama_barang', 'like', "%{$search}%")
              ->orWhere('kode_barang', 'like', "%{$search}%")
              ->orWhere('jenis_barang', 'like', "%{$search}%")
              ->orWhere('status_verifikasi', 'like', "%{$search}%");
        });
    }

    $penerimaan = $query->latest()->get();

    // Flash message hanya ditambahkan jika ada parameter search
    if ($request->has('search')) {
        if ($penerimaan->isEmpty()) {
            session()->flash('search_not_found', $search);
        } else {
            session()->flash('search_success', $search);
        }
    }

    return view('penerimaan_barang.index', compact('penerimaan'));
}


    public function create()
    {
        if (!$this->isAuthorized()) abort(403, 'Kamu tidak diizinkan menambah data.');

        $supplier = Supplier::orderBy('nama_supplier')->get();
        $lastKode = Barang::latest()->first()?->kode_barang ?? 'BRG0000';
        $nextKode = 'BRG' . str_pad((int)substr($lastKode, 3) + 1, 4, '0', STR_PAD_LEFT);

        return view('penerimaan_barang.create', compact('supplier', 'nextKode'));
    }

    public function store(Request $request)
    {
        if (!$this->isAuthorized()) abort(403, 'Kamu tidak diizinkan menyimpan data.');

      $request->validate([
    'nama_barang'        => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
    'jenis_barang'       => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
    'supplier_id'        => 'required|exists:supplier,id',
    'jumlah_diterima'    => 'required|integer|min:1',
    'tanggal_masuk'      => 'required|date',
    'tanggal_kadaluarsa' => 'required|date',
], [
    'nama_barang.regex'  => 'Nama barang hanya boleh huruf dan spasi, tidak boleh mengandung angka atau simbol.',
    'jenis_barang.regex' => 'Jenis barang hanya boleh huruf dan spasi, tidak boleh mengandung angka atau simbol.',
    'nama_barang.required' => 'Kolom nama barang wajib diisi.',
        'jenis_barang.required' => 'Kolom jenis barang wajib diisi.',
        'supplier_id.required' => 'Kolom supplier wajib dipilih.',
        'jumlah_diterima.required' => 'Jumlah diterima wajib diisi.',
        'jumlah_diterima.numeric' => 'Jumlah harus berupa angka.',
        'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
        'tanggal_kadaluarsa.required' => 'Tanggal kadaluarsa wajib diisi.',
        'tanggal_kadaluarsa.after' => 'Tanggal kadaluarsa harus setelah tanggal masuk.',
]);

        do {
            $latestId = Barang::max('id') ?? 0;
            $nextKode = 'BRG' . str_pad($latestId + 1, 4, '0', STR_PAD_LEFT);
        } while (Barang::where('kode_barang', $nextKode)->exists());

        $barang = Barang::create([
            'kode_barang'   => $nextKode,
            'nama_barang'   => $request->nama_barang,
            'jenis_barang'  => $request->jenis_barang,
            'supplier_id'   => $request->supplier_id,
        ]);

        PenerimaanBarang::create([
            'barang_id'         => $barang->id,
            'supplier_id'       => $request->supplier_id,
            'jumlah_diterima'   => $request->jumlah_diterima,
            'tanggal_masuk'     => $request->tanggal_masuk,
            'tanggal_kadaluarsa'=> $request->tanggal_kadaluarsa,
            'petugas_id'        => Auth::id(),
        ]);

        return redirect()->route('penerimaan_barang.index')->with('success', 'Barang berhasil diterima.');
    }

    public function edit(PenerimaanBarang $penerimaan_barang)
    {
        if (!$this->isAuthorized()) abort(403, 'Kamu tidak diizinkan mengedit data.');

        $barang   = Barang::orderBy('nama_barang')->get();
        $supplier = Supplier::orderBy('nama_supplier')->get();

        return view('penerimaan_barang.edit', compact('penerimaan_barang', 'barang', 'supplier'));
    }

    public function update(Request $request, PenerimaanBarang $penerimaan_barang)
    {
        if (!$this->isAuthorized()) abort(403, 'Kamu tidak diizinkan mengubah data.');

        $validated = $request->validate([
            'barang_id'          => 'required|exists:barang,id',
            'supplier_id'        => 'required|exists:supplier,id',
            'jumlah_diterima'    => 'required|integer|min:1',
            'tanggal_masuk'      => 'required|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'status_verifikasi'  => 'required|in:Belum Terverifikasi,Terverifikasi,Ditolak',
        ]);

        $penerimaan_barang->update($validated);

        return redirect()->route('penerimaan_barang.index')->with('success', 'Penerimaan berhasil diupdate!');
    }

    public function destroy(PenerimaanBarang $penerimaan_barang)
    {
        if (!$this->isAuthorized()) abort(403, 'Kamu tidak diizinkan menghapus data.');

        $penerimaan_barang->delete();

        return redirect()->route('penerimaan_barang.index')->with('success', 'Penerimaan berhasil dihapus!');
    }
}
