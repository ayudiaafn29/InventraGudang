@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Edit Permintaan Barang</h1>
    <form id="editForm" action="{{ route('permintaan_barang.update', $permintaan->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pilih Barang dari Penyimpanan --}}
        <div class="mb-4">
            <label for="penyimpanan_id" class="block text-sm font-medium text-gray-700">Pilih Barang dari Penyimpanan</label>
            <select name="penyimpanan_id" id="penyimpananSelect"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white" required onchange="setNamaBarang()">
                <option value="" disabled selected>Pilih Barang</option>
                @foreach ($penyimpanan as $p)
                    <option value="{{ $p->id }}"
                        data-nama="{{ $p->penerimaan->barang->nama_barang ?? 'Tidak ada' }}"
                        {{ $permintaan->penyimpanan_id == $p->id ? 'selected' : '' }}>
                        #{{ $p->id }} - {{ $p->penerimaan->barang->nama_barang ?? 'Tidak ada' }} (Stok: {{ $p->jumlah_stok }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Nama Barang (Readonly) --}}
        <div class="mb-4">
            <label for="nama_barang_diminta" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" name="nama_barang_diminta" id="namaBarangInput"
                   class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100" readonly
                   value="{{ $permintaan->nama_barang_diminta }}">
        </div>

        {{-- Jumlah Barang --}}
        <div class="mb-4">
            <label for="jumlah_barang_diminta" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
            <input type="number" name="jumlah_barang_diminta"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ $permintaan->jumlah_barang_diminta }}" required>
        </div>

        {{-- Status Permintaan --}}
        <div class="mb-4">
            <label for="status_permintaan" class="block text-sm font-medium text-gray-700">Status Permintaan</label>
            <select name="status_permintaan"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white" required>
                <option value="pending" {{ $permintaan->status_permintaan == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ $permintaan->status_permintaan == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="ditolak" {{ $permintaan->status_permintaan == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        {{-- Tanggal Kadaluarsa --}}
        <div class="mb-6">
            <label for="tanggal_kadaluarsa" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_kadaluarsa"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ $permintaan->tanggal_kadaluarsa }}">
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-2">
            <a href="{{ route('permintaan_barang.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm px-4 py-2 rounded transition">
                Batal
            </a>
            <button type="button" onclick="toggleModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded transition">
                Perbarui
            </button>
        </div>
    </form>
</div>

{{-- Modal Konfirmasi --}}
<div id="modalKonfirmasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg transform scale-100 transition-transform duration-300">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Perubahan</h2>
        <p class="text-sm mb-6">Apakah Anda yakin ingin menyimpan perubahan ini?</p>
        <div class="flex justify-end gap-2">
            <button onclick="toggleModal()" class="px-4 py-2 text-sm bg-gray-300 rounded hover:bg-gray-400">
                Batal
            </button>
            <button type="submit" form="editForm" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                Yakin & Simpan
            </button>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
    function toggleModal() {
        const modal = document.getElementById('modalKonfirmasi');
        modal.classList.toggle('opacity-0');
        modal.classList.toggle('pointer-events-none');
    }

    function setNamaBarang() {
        const select = document.getElementById("penyimpananSelect");
        const selectedOption = select.options[select.selectedIndex];
        const namaBarang = selectedOption.getAttribute("data-nama");
        document.getElementById("namaBarangInput").value = namaBarang || '';
    }

    document.addEventListener("DOMContentLoaded", setNamaBarang);
</script>
@endsection
