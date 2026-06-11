<?php

namespace App\Http\Controllers;

use App\Models\PermintaanBarang;
use App\Models\PenyimpananBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanBarangController extends Controller
{
    // Email yang diizinkan akses tambah/edit/hapus
    private $allowedEmails = [
        'permintaan@gudang.com',
        'manager@gudang.com'
    ];

    private function isAuthorized()
    {
        return in_array(Auth::user()->email, $this->allowedEmails);
    }

    public function index(Request $request)
    {
        $query = PermintaanBarang::with('penyimpanan.penerimaan.barang');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('penyimpanan.penerimaan.barang', function ($q) use ($search) {
                $q->where('nama_barang', 'like', '%' . $search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $search . '%')
                  ->orWhere('jenis_barang', 'like', '%' . $search . '%');
            });
        }

        $permintaan = $query->latest()->get();
 if ($request->has('search')) {
    if($permintaan->isEmpty()){
            session()->flash('search_not_found', $search);
        } else {
            session()->flash('search_success', $search);
        }
    }
        return view('permintaan_barang.index', compact('permintaan'));
    }

    public function create()
    {
        // Hanya tampilkan penyimpanan dengan stok > 0
        $penyimpanan = PenyimpananBarang::with('penerimaan.barang')
                        ->where('jumlah_stok', '>', 0)
                        ->get();

        return view('permintaan_barang.create', compact('penyimpanan'));
    }

    public function store(Request $request)
    {
        if (!$this->isAuthorized()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'penyimpanan_id'        => 'required|exists:penyimpanan_barang,id',
            'nama_barang_diminta'   => 'required|string|max:100',
            'jumlah_barang_diminta' => 'required|integer|min:1',
            'tanggal_kadaluarsa'    => 'required|date',
            'tujuan_pengiriman' => 'required|string|max:255',
        ], [
            'penyimpanan_id.required'        => 'Silakan pilih barang dari penyimpanan.',
            'nama_barang_diminta.required'   => 'Nama barang wajib diisi.',
            'jumlah_barang_diminta.required' => 'Jumlah barang diminta harus diisi.',
            'jumlah_barang_diminta.integer'  => 'Jumlah barang harus berupa angka.',
            'jumlah_barang_diminta.min'      => 'Jumlah barang minimal 1.',
            'tanggal_kadaluarsa.required'    => 'Tanggal kadaluarsa harus diisi.',
            'tanggal_kadaluarsa.date'        => 'Format tanggal kadaluarsa tidak valid.',
            'tujuan_pengiriman.required'     => 'Tujuan Pengiriman Harus diisi',
        ]);

        $penyimpanan = PenyimpananBarang::findOrFail($request->penyimpanan_id);

        // Cek apakah stok mencukupi
        if ($penyimpanan->jumlah_stok < $request->jumlah_barang_diminta) {
            return redirect()->back()->withErrors([
                'jumlah_barang_diminta' => 'Stok tidak mencukupi. Sisa stok hanya ' . $penyimpanan->jumlah_stok . '.'
            ])->withInput();
        }

        // Simpan permintaan
        PermintaanBarang::create([
            'penyimpanan_id'        => $request->penyimpanan_id,
            'nama_barang_diminta'   => $request->nama_barang_diminta,
            'jumlah_barang_diminta' => $request->jumlah_barang_diminta,
            'tanggal_kadaluarsa'    => $request->tanggal_kadaluarsa,
            'tujuan_pengiriman'     => $request->tujuan_pengiriman,
            'status_permintaan'     => 'pending',
        ]);

        // Kurangi stok
        $penyimpanan->jumlah_stok -= $request->jumlah_barang_diminta;
        $penyimpanan->save();

        return redirect()->route('permintaan_barang.index')
                         ->with('success', 'Permintaan barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $permintaan = PermintaanBarang::findOrFail($id);
        $penyimpanan = PenyimpananBarang::with('penerimaan.barang')->get();

        return view('permintaan_barang.edit', compact('permintaan', 'penyimpanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penyimpanan_id'        => 'required|exists:penyimpanan_barang,id',
            'nama_barang_diminta'   => 'required|string|max:100',
            'jumlah_barang_diminta' => 'required|integer|min:1',
            'status_permintaan'     => 'required|in:pending,diproses,ditolak',
            'tanggal_kadaluarsa'    => 'nullable|date',
        ]);

        $permintaan = PermintaanBarang::findOrFail($id);
        $permintaan->penyimpanan_id = $request->penyimpanan_id;
        $permintaan->nama_barang_diminta = $request->nama_barang_diminta;
        $permintaan->jumlah_barang_diminta = $request->jumlah_barang_diminta;
        $permintaan->status_permintaan = $request->status_permintaan;
        $permintaan->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;
        $permintaan->save();

        return redirect()->route('permintaan_barang.index')->with('success', 'Permintaan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        PermintaanBarang::destroy($id);
        return redirect()->route('permintaan_barang.index')
                         ->with('success', 'Permintaan barang berhasil dihapus');
    }
}
