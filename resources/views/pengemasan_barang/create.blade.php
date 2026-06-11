@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Tambah Data Pengemasan</h1>
    <form action="{{ route('pengemasan_barang.store') }}" method="POST">
        @csrf

        {{-- Pilih Permintaan Barang --}}
        <div class="mb-4">
            <label for="permintaan_id" class="block text-sm font-medium text-gray-700">Pilih Barang Yang Diminta</label>
            <select name="permintaan_id" id="permintaanSelect"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white" onchange="setDetailBarang()">
                <option value="" disabled selected>Pilih Data Permintaan</option>
                @foreach($permintaan as $p)
                    <option value="{{ $p->id }}"
                            data-nama="{{ $p->nama_barang_diminta }}"
                            data-jumlah="{{ $p->jumlah_barang_diminta }}"
                           data-tujuan="{{ $p->tujuan_pengiriman ?? '-' }}">
                        #{{ $p->id }} - {{ $p->nama_barang_diminta }} ({{ $p->jumlah_barang_diminta }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nama Barang --}}
        <div class="mb-4">
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" id="namaBarangDisplay"
                   class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100"
                   readonly>
        </div>

        {{-- Jumlah Barang Dikemas --}}
        <div class="mb-4">
            <label for="jumlah_barang_dikemas" class="block text-sm font-medium text-gray-700">Jumlah Barang Dikemas</label>
            <input type="number" name="jumlah_barang_dikemas" id="jumlahBarangInput"
                   class="mt-1 block w-full border rounded px-3 py-2" >
        </div>

        {{-- Tujuan Pengiriman (Opsional) --}}
        <div class="mb-4">
            <label for="tujuan_pengiriman" class="block text-sm font-medium text-gray-700">Tujuan Pengiriman</label>
            <input type="text" name="tujuan_pengiriman" id="tujuanPengiriman"
                   class="mt-1 block w-full border rounded px-3 py-2" readonly>
        </div>

        {{-- Tanggal Pengemasan --}}
        <div class="mb-6">
            <label for="tanggal_pengemasan" class="block text-sm font-medium text-gray-700">Tanggal Pengemasan</label>
            <input type="date" name="tanggal_pengemasan"
                   class="mt-1 block w-full border rounded px-3 py-2" >
        </div>

        {{-- Tombol --}}
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded">
                Simpan
            </button>
            <a href="{{ route('pengemasan_barang.index') }}"
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


{{-- Script autofill --}}
<script>
    function setDetailBarang() {
        const select = document.getElementById("permintaanSelect");
        const selectedOption = select.options[select.selectedIndex];

        const namaBarang = selectedOption.getAttribute("data-nama") || '';
        const jumlahBarang = selectedOption.getAttribute("data-jumlah") || '';
        const tujuan = selectedOption.getAttribute("data-tujuan") || '';

        document.getElementById("namaBarangDisplay").value = namaBarang;
        document.getElementById("jumlahBarangInput").value = jumlahBarang;
        document.getElementById("tujuanPengiriman").value = tujuan;
    }

    document.addEventListener("DOMContentLoaded", setDetailBarang);
</script>
@endsection
