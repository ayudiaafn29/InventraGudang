@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Edit Pengemasan Barang</h1>
    <form id="editPengemasanForm" action="{{ route('pengemasan_barang.update', $pengemasan->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pilih Permintaan --}}
        <div class="mb-4">
            <label for="permintaan_id" class="block text-sm font-medium text-gray-700">Pilih Permintaan</label>
            <select name="permintaan_id" id="permintaan_id"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white" required>
                @foreach($permintaan as $pm)
                    <option value="{{ $pm->id }}" @selected($pm->id == $pengemasan->permintaan_id)>
                        #{{ $pm->id }} - {{ $pm->nama_barang_diminta }} ({{ $pm->jumlah_barang_diminta }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah Barang Dikemas --}}
        <div class="mb-4">
            <label for="jumlah_barang_dikemas" class="block text-sm font-medium text-gray-700">Jumlah Barang Dikemas</label>
            <input type="number" name="jumlah_barang_dikemas" id="jumlah_barang_dikemas"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ old('jumlah_barang_dikemas', $pengemasan->jumlah_barang_dikemas) }}" required>
        </div>

        {{-- Tujuan Pengiriman --}}
        <div class="mb-4">
            <label for="tujuan_pengiriman" class="block text-sm font-medium text-gray-700">Tujuan Pengiriman</label>
            <input type="text" name="tujuan_pengiriman" id="tujuan_pengiriman"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ old('tujuan_pengiriman', $pengemasan->tujuan_pengiriman) }}" required>
        </div>

        {{-- Tanggal Pengemasan --}}
        <div class="mb-4">
            <label for="tanggal_pengemasan" class="block text-sm font-medium text-gray-700">Tanggal Pengemasan</label>
            <input type="date" name="tanggal_pengemasan" id="tanggal_pengemasan"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ old('tanggal_pengemasan', $pengemasan->tanggal_pengemasan) }}" required>
        </div>

        {{-- Status Pengemasan --}}
        <div class="mb-6">
            <label for="status_pengemasan" class="block text-sm font-medium text-gray-700">Status Pengemasan</label>
            @php $status = old('status_pengemasan', $pengemasan->status_pengemasan); @endphp
            <select name="status_pengemasan" id="status_pengemasan"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white">
                <option value="sedang dikemas"  @selected($status == 'sedang dikemas')>Sedang Dikemas</option>
                <option value="siap dikirim" @selected($status == 'siap dikirim')>Siap Dikirim</option>
            </select>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-2">
            <a href="{{ route('pengemasan_barang.index') }}"
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
            <button type="submit" form="editPengemasanForm" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
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
</script>
@endsection
