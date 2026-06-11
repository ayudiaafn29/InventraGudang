<?php

namespace App\Http\Controllers;

use App\Models\PenerimaanBarang;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaanBarangController extends Controller
{
    /**
     * List semua penerimaan.
     */
    public function index()
    {
        $penerimaan = PenerimaanBarang::with('barang', 'supplier', 'petugas')->latest()->get();
        return view('penerimaan_barang.index', compact('penerimaan'));
    }

    /**
     * Form tambah.
     */
    public function create()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        $supplier = Supplier::orderBy('nama_supplier')->get();
        return view('penerimaan_barang.create', compact('barang', 'supplier'));
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'        => 'required|exists:barang,id',
            'supplier_id'      => 'required|exists:supplier,id',
            'jumlah_diterima'  => 'required|integer|min:1',
            'tanggal_masuk'    => 'required|date',
        ]);

        PenerimaanBarang::create([
            'barang_id'        => $request->barang_id,
            'supplier_id'      => $request->supplier_id,
            'petugas_id'       => Auth::id(),
            'jumlah_diterima'  => $request->jumlah_diterima,
            'tanggal_masuk'    => $request->tanggal_masuk,
            'status_verifikasi'=> 'pending',
        ]);

        return redirect()
            ->route('penerimaan_barang.index')
            ->with('success', 'Data penerimaan barang berhasil ditambahkan.');
    }

    /**
     * Form edit.
     * Route-model binding otomatis.
     */
    public function edit(PenerimaanBarang $penerimaan_barang)
    {
        $barang   = Barang::orderBy('nama_barang')->get();
        $supplier = Supplier::orderBy('nama_supplier')->get();

        return view('penerimaan_barang.edit', compact('penerimaan_barang', 'barang', 'supplier'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, PenerimaanBarang $penerimaan_barang)
    {
        $request->validate([
            'barang_id'        => 'required|exists:barang,id',
            'supplier_id'      => 'required|exists:supplier,id',
            'jumlah_diterima'  => 'required|integer|min:1',
            'tanggal_masuk'    => 'required|date',
            'status_verifikasi'=> 'nullable|string', // kalau mau edit status
        ]);

        $penerimaan_barang->update([
            'barang_id'        => $request->barang_id,
            'supplier_id'      => $request->supplier_id,
            'jumlah_diterima'  => $request->jumlah_diterima,
            'tanggal_masuk'    => $request->tanggal_masuk,
            'status_verifikasi'=> $request->status_verifikasi ?? $penerimaan_barang->status_verifikasi,
        ]);

        return redirect()
            ->route('penerimaan_barang.index')
            ->with('success', 'Data penerimaan barang berhasil diperbarui.');
    }

    /**
     * Hapus.
     */
    public function destroy(PenerimaanBarang $penerimaan_barang)
    {
        $penerimaan_barang->delete();

        return redirect()
            ->route('penerimaan_barang.index')
            ->with('success', 'Data penerimaan barang berhasil dihapus.');
    }

    /**
     * (Opsional) Detail per penerimaan.
     */
    public function show(PenerimaanBarang $penerimaan_barang)
    {
        return view('penerimaan_barang.show', compact('penerimaan_barang'));
    }
}
