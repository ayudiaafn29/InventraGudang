<?php

namespace App\Http\Controllers;

use App\Models\PengirimanBarang;
use App\Models\PengemasanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PengirimanBarangController extends Controller
{
           // Daftar email yang diizinkan akses tambah/edit/hapus
    private $allowedEmails = [
    'pengantar@gudang.com', 
    'manager@gudang.com'
];

    private function isAuthorized()
    {
        return in_array(Auth::user()->email, $this->allowedEmails);
    }
    public function index(Request $request)
{
    $query = PengirimanBarang::with(['pengemasan.permintaan.penyimpanan.penerimaan.barang']);

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->whereHas('pengemasan.permintaan.penyimpanan.penerimaan.barang', function ($q) use ($search) {
            $q->where('nama_barang', 'like', "%$search%")
            ->orWhere('kode_barang', 'like', "%$search%")
            ->orWhere('status_pengiriman', 'like', "%$search%")
              ->orWhere('tujuan_pengiriman', 'like', "%$search%");
        })->orWhere('nama_penerima', 'like', "%$search%")

;
    }

    $pengiriman = $query->latest()->get();
if ($request->has('search')) {
    if ($pengiriman->isEmpty()) {
        session()->flash('search_not_found', $search);
    } else {
        session()->flash('search_success', $search);
    }
}

    return view('pengiriman_barang.index', compact('pengiriman'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Ambil ID pengemasan yang sudah pernah digunakan di pengiriman
    $usedPengemasanIds = PengirimanBarang::pluck('pengemasan_id');

    // Ambil data pengemasan yang belum digunakan
    $pengemasan = PengemasanBarang::whereNotIn('id', $usedPengemasanIds)->get();

    return view('pengiriman_barang.create', compact('pengemasan'));
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'pengemasan_id' => 'required|exists:pengemasan_barang,id',
        'nama_penerima' => ['required','regex:/^[a-zA-Z\s]*$/'],
        'tujuan_pengiriman' => 'required|string|max:255',
        'tanggal_dikirim' => 'required|date',

    
    ],
    [
        'pengemasan_id.required' => 'Pengemasan tidak boleh kosong',
        'pengemasan_id.exists' => 'Pengemasan tidak ditemukan',
        'nama_penerima.regex'=>'Nama Penerima Harus Huruf dan spasi saja',
        'nama_penerima.required' => 'Nama penerima tidak boleh kosong',
        'tujuan_pengiriman.required' => 'Tujuan Pengiriman tidak boleh kosong',
        'tanggal_dikirim.required' => 'Tanggal Dikirim tidak boleh kosong',
    ]);

    $validated['status_pengiriman'] = 'dikirim'; // default status, bisa disesuaikan

    PengirimanBarang::create($validated);

    return redirect()->route('pengiriman_barang.index')->with('success', 'Data pengiriman berhasil disimpan.');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengiriman = PengirimanBarang::findOrFail($id);
        $pengemasan = PengemasanBarang::all();
        return view('pengiriman_barang.edit', compact('pengiriman', 'pengemasan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pengemasan_id' => 'required|exists:pengemasan_barang,id',
            'nama_penerima' => 'required|string|max:100',
            'status_pengiriman' => 'required|string',
            'tanggal_dikirim' => 'required|date',
        ]);

        $pengiriman = PengirimanBarang::findOrFail($id);
        $pengiriman->update($request->all());
        return redirect()->route('pengiriman_barang.index')->with('success', 'Data pengiriman berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PengirimanBarang::destroy($id);
        return redirect()->route('pengiriman_barang.index')->with('success', 'Data pengiriman berhasil dihapus');
    }
}
