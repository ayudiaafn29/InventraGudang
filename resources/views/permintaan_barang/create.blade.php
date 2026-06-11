@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Tambah Permintaan Barang</h1>
    <form action="{{ route('permintaan_barang.store') }}" method="POST">
        @csrf

        {{-- Pilih Penyimpanan --}}
        <div class="mb-4">
            <label for="penyimpanan_id" class="block text-sm font-medium text-gray-700">Pilih Barang Dari Penyimpanan</label>
            <select name="penyimpanan_id" id="penyimpananSelect"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white"  onchange="setNamaBarang()">
                <option value="" disabled selected>Pilih Barang</option>
                @foreach($penyimpanan as $p)
                    <option value="{{ $p->id }}"
                            data-nama="{{ $p->penerimaan->barang->nama_barang ?? 'Tidak ada' }}">
                        #{{ $p->id }} - {{ $p->penerimaan->barang->nama_barang ?? 'Tidak ada' }} (Stok: {{ $p->jumlah_stok }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tampilkan Nama Barang (Readonly) --}}
        <div class="mb-4">
            <label for="nama_barang_diminta_display" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" id="namaBarangDisplay"
                   class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100"
                   placeholder="Nama barang otomatis muncul" readonly>
        </div>

        {{-- Input Hidden: Nama Barang Diminta --}}
        <input type="hidden" name="nama_barang_diminta" id="namaBarangInput">

        {{-- Jumlah Barang Diminta --}}
        <div class="mb-4">
            <label for="jumlah_barang_diminta" class="block text-sm font-medium text-gray-700">Jumlah Barang Diminta</label>
            <input type="number" name="jumlah_barang_diminta"
                   class="mt-1 block w-full border rounded px-3 py-2" placeholder="Contoh: 50" >
        </div>
<div class="form-group">
    <label for="tujuan_pengiriman">Tujuan Pengiriman</label>
    <input type="text" name="tujuan_pengiriman" id="tujuan_pengiriman" class="form-control" >
</div>

        {{-- Tanggal Kadaluarsa --}}
        <div class="mb-6">
            <label for="tanggal_kadaluarsa" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_kadaluarsa"
                   class="mt-1 block w-full border rounded px-3 py-2">
        </div>

        {{-- Tombol --}}
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded">
                Simpan
            </button>
            <a href="{{ route('permintaan_barang.index') }}"
               class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </form>
</div>
{{-- SweetAlert untuk Validasi --}}
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Input Tidak Valid',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33',
            });
        });
    </script>
@endif

{{-- Script Auto-Fill Nama Barang --}}
<script>
    function setNamaBarang() {
        const select = document.getElementById("penyimpananSelect");
        const selectedOption = select.options[select.selectedIndex];
        const namaBarang = selectedOption.getAttribute("data-nama") || '';

        // Set ke input readonly & input hidden
        document.getElementById("namaBarangDisplay").value = namaBarang;
        document.getElementById("namaBarangInput").value = namaBarang;
    }

    document.addEventListener("DOMContentLoaded", setNamaBarang);
</script>
@endsection
