@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Edit Penyimpanan Barang</h1>
        <form id="editForm" action="{{ route('penyimpanan_barang.update', $penyimpanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Pilih Penerimaan --}}
            <div class="mb-4">
                <label for="penerimaan_id" class="block text-sm font-medium text-gray-700">Pilih Penerimaan</label>
                <select name="penerimaan_id" id="penerimaan_id" class="mt-1 block w-full border rounded px-3 py-2" required>
                    @foreach ($penerimaan as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $penyimpanan->penerimaan_id ? 'selected' : '' }}>
                            #{{ $p->id }} - {{ $p->barang->nama_barang ?? '-' }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Lokasi Penyimpanan --}}
            <div class="mb-4">
                <label for="lokasi_penyimpanan" class="block text-sm font-medium text-gray-700">Lokasi Penyimpanan</label>
                <input type="text" name="lokasi_penyimpanan" value="{{ $penyimpanan->lokasi_penyimpanan }}"
                       class="mt-1 block w-full border rounded px-3 py-2" required>
            </div>

            {{-- Kategori Barang --}}
            <div class="mb-4">
                <label for="kategori_barang" class="block text-sm font-medium text-gray-700">Kategori Barang</label>
                <input type="text" name="kategori_barang" value="{{ $penyimpanan->kategori_barang }}"
                       class="mt-1 block w-full border rounded px-3 py-2" required>
            </div>

            {{-- Kapasitas Rak --}}
            <div class="mb-4">
                <label for="kapasitas_rak" class="block text-sm font-medium text-gray-700">Kapasitas Rak</label>
                <input type="number" name="kapasitas_rak" value="{{ $penyimpanan->kapasitas_rak }}"
                       class="mt-1 block w-full border rounded px-3 py-2" required>
            </div>

            {{-- Jumlah Stok --}}
            <div class="mb-4">
                <label for="jumlah_stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                <input type="number" name="jumlah_stok" value="{{ $penyimpanan->jumlah_stok }}"
                       class="mt-1 block w-full border rounded px-3 py-2" required>
            </div>

            {{-- Tanggal Kadaluarsa --}}
            <div class="mb-4">
                <label for="tanggal_kadaluarsa" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" value="{{ $penyimpanan->tanggal_kadaluarsa }}"
                       class="mt-1 block w-full border rounded px-3 py-2">
            </div>

            {{-- Status Barang --}}
            <div class="mb-6">
                <label for="status_barang" class="block text-sm font-medium text-gray-700">Status Barang</label>
                <select name="status_barang" id="status_barang" class="mt-1 block w-full border rounded px-3 py-2" required>
                    <option value="Belum Disimpan" {{ $penyimpanan->status_barang == 'Belum Disimpan' ? 'selected' : '' }}>Belum Disimpan</option>
                    <option value="Disimpan" {{ $penyimpanan->status_barang == 'Disimpan' ? 'selected' : '' }}>Disimpan</option>
                </select>
            </div>

           {{-- Tombol Aksi --}}
<div class="flex justify-end gap-2 mt-4">
    <a href="{{ route('penyimpanan_barang.index') }}"
       class="bg-gray-300 hover:bg-gray-400 text-sm text-gray-800 px-4 py-1.5 rounded transition">
        Batal
    </a>
    <button type="button" onclick="toggleModal()"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-1.5 rounded transition">
        Simpan Perubahan
    </button>
</div>


   {{-- Modal Konfirmasi --}}
<div id="modalKonfirmasi" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg transform scale-100 transition-transform duration-300">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Perubahan</h2>
        <p class="text-sm mb-6">Apakah Anda yakin ingin menyimpan perubahan ini?</p>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="toggleModal()" class="px-4 py-2 text-sm bg-gray-300 rounded hover:bg-gray-400">
                Batal
            </button>
            <button type="button" onclick="submitForm()" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                Yakin & Simpan
            </button>
        </div>
    </div>
</div>

@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
@endif

   <script>
    function toggleModal() {
        const modal = document.getElementById('modalKonfirmasi');
        modal.classList.toggle('opacity-0');
        modal.classList.toggle('pointer-events-none');
    }

    function submitForm() {
        document.getElementById('editForm').submit();
    }
</script>

@endsection
