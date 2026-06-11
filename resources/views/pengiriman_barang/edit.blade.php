@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Edit Pengiriman Barang</h1>
    <form id="editPengirimanForm" action="{{ route('pengiriman_barang.update', $pengiriman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <select name="pengemasan_id" id="pengemasanSelect"
    class="mt-1 block w-full border rounded px-3 py-2 bg-white" required onchange="setDetailPengemasan()">
    <option value="" disabled selected>Pilih Data Pengemasan</option>
    @foreach($pengemasan as $pm)
        <option value="{{ $pm->id }}"
            data-penerima="{{ $pm->permintaan->nama_penerima }}"
            data-tujuan="{{ $pm->tujuan_pengiriman }}"
            @selected($pm->id == $pengiriman->pengemasan_id)>
            #{{ $pm->id }} - {{ $pm->permintaan->penyimpanan->penerimaan->barang->nama_barang }} ({{ $pm->permintaan->jumlah_barang_diminta }})
        </option>
    @endforeach
</select>


        {{-- Nama Penerima --}}
        <div class="mb-4">
            <label for="nama_penerima" class="block text-sm font-medium text-gray-700">Nama Penerima</label>
            <input type="text" name="nama_penerima" id="nama_penerima"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ old('nama_penerima', $pengiriman->nama_penerima) }}" required>
        </div>

        {{-- Tujuan Pengiriman --}}
        <div class="mb-4">
            <label for="tujuan_pengiriman" class="block text-sm font-medium text-gray-700">Tujuan Pengiriman</label>
            <input type="text" name="tujuan_pengiriman" id="tujuan_pengiriman"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ old('tujuan_pengiriman', $pengiriman->tujuan_pengiriman) }}" required>
        </div>

        {{-- Tanggal Pengiriman --}}
        <div class="mb-4">
            <label for="tanggal_dikirim" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
            <input type="date" name="tanggal_dikirim" id="tanggal_dikirim"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   value="{{ old('tanggal_dikirim', $pengiriman->tanggal_dikirim) }}" required>
        </div>

        {{-- Status Pengiriman --}}
        <div class="mb-6">
            <label for="status_pengiriman" class="block text-sm font-medium text-gray-700">Status Pengiriman</label>
            @php $status = old('status_pengiriman', $pengiriman->status_pengiriman); @endphp
            <select name="status_pengiriman" id="status_pengiriman"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white">
                <option value="sedang dikirim" @selected($status == 'sedang dikirim')>Sedang Dikirim</option>
                <option value="selesai dikirim" @selected($status == 'selesai dikirim')>Selesai Dikirim</option>
            </select>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-2">
            <a href="{{ route('pengiriman_barang.index') }}"
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
            <button type="submit" form="editPengirimanForm" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
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
