@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Edit Penerimaan Barang</h1>
        <form id="editForm" action="{{ route('penerimaan_barang.update', $penerimaan_barang->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Barang --}}
            <div class="mb-4">
                <label for="barang_id" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <select name="barang_id" class="mt-1 block w-full border rounded px-3 py-2" required>
                    <option disabled selected>Pilih Barang</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id }}" {{ $penerimaan_barang->barang_id == $b->id ? 'selected' : '' }}>
                            {{ $b->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Supplier --}}
            <div class="mb-4">
                <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                <select name="supplier_id" class="mt-1 block w-full border rounded px-3 py-2" required>
                    <option disabled selected>Pilih Supplier</option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->id }}" {{ $penerimaan_barang->supplier_id == $s->id ? 'selected' : '' }}>
                            {{ $s->nama_supplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah Diterima --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jumlah Diterima</label>
                <div class="flex">
                    <input type="number" name="jumlah_diterima" value="{{ $penerimaan_barang->jumlah_diterima }}"
                           class="w-full border rounded-l px-3 py-2" min="1" required>
                    <span class="inline-flex items-center px-3 bg-gray-200 border border-l-0 rounded-r text-sm">kg</span>
                </div>
            </div>

            {{-- Tanggal Masuk --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" value="{{ $penerimaan_barang->tanggal_masuk }}"
                       class="mt-1 block w-full border rounded px-3 py-2" required>
            </div>

            {{-- Tanggal Kadaluarsa --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_masuk" value="{{ $penerimaan_barang->tanggal_kadaluarsa }}"
                       class="mt-1 block w-full border rounded px-3 py-2" required>
            </div>

            {{-- Status Verifikasi --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Status Verifikasi</label>
                <select name="status_verifikasi" class="mt-1 block w-full border rounded px-3 py-2" required>
                    <option value="Pending" {{ $penerimaan_barang->status_verifikasi == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Terverifikasi" {{ $penerimaan_barang->status_verifikasi == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="Ditolak" {{ $penerimaan_barang->status_verifikasi == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                <button onclick="toggleModal()"
                        class="px-4 py-2 text-sm bg-gray-300 rounded hover:bg-gray-400">
                    Batal
                </button>
                <button type="submit" form="editForm"
                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                    Yakin & Simpan
                </button>
            </div>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('modalKonfirmasi');
            if (modal.classList.contains('opacity-0')) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }
        }
    </script>
@endsection
