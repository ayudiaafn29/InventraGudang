@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Tambah Data Pengiriman</h1>

    <form action="{{ route('pengiriman_barang.store') }}" method="POST">
        @csrf

        {{-- Pilih Pengemasan --}}
        <div class="mb-4">
            <label for="pengemasan_id" class="block text-sm font-medium text-gray-700">Pilih Pengemasan</label>
            <select name="pengemasan_id" id="pengemasanSelect"
                class="mt-1 block w-full border rounded px-3 py-2 bg-white"  onchange="setDetailPengemasan()">
                <option value="" disabled selected>Pilih Data Pengemasan</option>
                @foreach($pengemasan as $p)
                    <option value="{{ $p->id }}"
                        data-nama="{{ $p->permintaan->nama_barang_diminta }}"
                        data-jumlah="{{ $p->permintaan->jumlah_barang_diminta }}"
                        data-penerima="{{ $p->permintaan->nama_penerima }}"
                        data-tujuan="{{ $p->tujuan_pengiriman }}">
                        #{{ $p->id }} - {{ $p->permintaan->nama_barang_diminta }} ({{ $p->permintaan->jumlah_barang_diminta }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nama Barang --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" id="namaBarang" class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100" readonly>
        </div>

        {{-- Jumlah Barang --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
            <input type="text" id="jumlahBarang" class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100" readonly>
        </div>

        {{-- Nama Penerima (tidak readonly) --}}
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Nama Penerima</label>
    <input type="text" name="nama_penerima" id="namaPenerima"
           class="mt-1 block w-full border rounded px-3 py-2 bg-white" >
</div>


        {{-- Tujuan Pengiriman --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tujuan Pengiriman</label>
            <input type="text" name="tujuan_pengiriman" id="tujuanPengiriman"
                class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100" readonly>
        </div>

        {{-- Tanggal Pengiriman --}}
        <div class="mb-6">
            <label for="tanggal_dikirim" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
            <input type="date" name="tanggal_dikirim" class="mt-1 block w-full border rounded px-3 py-2" >
        </div>

        {{-- Tombol --}}
        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded">
                Simpan
            </button>
            <a href="{{ route('pengiriman_barang.index') }}"
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

<script>
    function setDetailPengemasan() {
        const select = document.getElementById("pengemasanSelect");
        const selected = select.options[select.selectedIndex];

        document.getElementById("namaBarang").value = selected.getAttribute("data-nama") || '';
        document.getElementById("jumlahBarang").value = selected.getAttribute("data-jumlah") || '';
        document.getElementById("namaPenerima").value = selected.getAttribute("data-penerima") || '';
        document.getElementById("tujuanPengiriman").value = selected.getAttribute("data-tujuan") || '';
    }

    document.addEventListener("DOMContentLoaded", setDetailPengemasan);
</script>
@endsection
