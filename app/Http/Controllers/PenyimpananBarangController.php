<?php

namespace App\Http\Controllers;

use App\Models\PenyimpananBarang;
use App\Models\PenerimaanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyimpananBarangController extends Controller
{
    // Daftar email yang diizinkan akses tambah/edit/hapus
    private $allowedEmails = [
        'penyimpanan@gudang.com', 
        'manager@gudang.com'
    ];

    private function isAuthorized()
    {
        return in_array(Auth::user()->email, $this->allowedEmails);
    }

    public function index(Request $request)
    {
        $query = PenyimpananBarang::with(['penerimaan.barang']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('penerimaan.barang', function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%$search%")
                  ->orWhere('kode_barang', 'like', "%$search%")
                  ->orWhere('jumlah_stok', 'like', "%$search%")
                  ->orWhere('status_barang', 'like', "%$search%");
            })->orWhere('lokasi_penyimpanan', 'like', "%$search%")
              ->orWhere('kategori_barang', 'like', "%$search%")
              ->orWhere('status_barang', 'like', "%$search%");
        }

        $penyimpanan = $query->get();
// Flash message hanya ditambahkan jika ada parameter search
    if ($request->has('search')) {
        if($penyimpanan->isEmpty()){
            session()->flash('search_not_found', $search);
        } else {
            session()->flash('search_success', $search);
        }
    }
        return view('penyimpanan_barang.index', compact('penyimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $penerimaan_tersimpan = PenyimpananBarang::pluck('penerimaan_id')->toArray();

    $penerimaan = PenerimaanBarang::whereNotIn('id', $penerimaan_tersimpan)->get();

    return view('penyimpanan_barang.create', compact('penerimaan'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'penerimaan_id'       => 'required|exists:penerimaan_barang,id',
        'lokasi_penyimpanan'  => 'required|string|max:100',
        'kategori_barang'     => ['required', 'string', 'max:50', 'regex:/^[A-Za-z\s]+$/'],
        'kapasitas_rak'       => 'required|integer|min:1',
        'jumlah_stok'         => 'required|integer|min:1',
        'tanggal_kadaluarsa'  => 'required|date',
    ], [
        'penerimaan_id.required'      => 'Field Penerimaan harus dipilih.',
        'lokasi_penyimpanan.required' => 'Lokasi penyimpanan tidak boleh kosong.',
        'kategori_barang.required'    => 'Kategori barang wajib diisi.',
        'kategori_barang.regex'       => 'Kategori barang hanya boleh huruf dan spasi.',
        'kapasitas_rak.required'      => 'Kapasitas rak tidak boleh kosong.',
        'kapasitas_rak.min'           => 'Kapasitas rak minimal harus 1.',
        'jumlah_stok.required'        => 'Jumlah stok harus diisi.',
        'jumlah_stok.integer'         => 'Jumlah stok harus berupa angka.',
        'jumlah_stok.min'             => 'Jumlah stok minimal harus 1.',
        'tanggal_kadaluarsa.required' => 'Tanggal kadaluarsa wajib diisi.',
    ]);

    // Cek apakah penerimaan_id sudah pernah disimpan
    $existing = PenyimpananBarang::where('penerimaan_id', $request->penerimaan_id)->first();
    if ($existing) {
        return redirect()->back()
            ->withErrors(['penerimaan_id' => 'Penerimaan ini sudah pernah digunakan untuk penyimpanan.'])
            ->withInput();
    }

    $data = $request->all();
    $data['petugas_id'] = Auth::id();
    $data['status_barang'] = 'Belum Disimpan';

    PenyimpananBarang::create($data);

    return redirect()->route('penyimpanan_barang.index')
                     ->with('success', 'Data penyimpanan berhasil ditambahkan');
}

public function edit(string $id)
    {
        $penyimpanan = PenyimpananBarang::findOrFail($id);
        $penerimaan = PenerimaanBarang::all();
        return view('penyimpanan_barang.edit', compact('penyimpanan', 'penerimaan'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'penerimaan_id'       => 'required|exists:penerimaan_barang,id',
            'lokasi_penyimpanan'  => 'required|string|max:100',
            'kategori_barang'     => ['required', 'string', 'max:50', 'regex:/^[A-Za-z\s]+$/'],
            'kapasitas_rak'       => 'required|integer|min:1',
            'jumlah_stok'         => 'required|integer|min:1',
            'tanggal_kadaluarsa'  => 'nullable|date',
            'status_barang'       => 'required|string',
        ], [
            'kategori_barang.regex' => 'Kategori barang hanya boleh mengandung huruf dan spasi.',
        ]);

        $penyimpanan = PenyimpananBarang::findOrFail($id);
        $penyimpanan->update($request->all());

        return redirect()->route('penyimpanan_barang.index')
                         ->with('success', 'Data penyimpanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PenyimpananBarang::destroy($id);
        return redirect()->route('penyimpanan_barang.index')
                         ->with('success', 'Data penyimpanan berhasil dihapus');
    }
}
