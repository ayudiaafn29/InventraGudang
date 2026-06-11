@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Tambah Penyimpanan Barang</h1>

    <form id="formPenyimpanan" action="{{ route('penyimpanan_barang.store') }}" method="POST">
        @csrf

        {{-- Pilih Penerimaan --}}
        <div class="mb-4">
            <label for="penerimaan_id" class="block text-sm font-medium text-gray-700">Pilih Penerimaan</label>
            <select name="penerimaan_id" id="penerimaan_id"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white" >
                <option value="" disabled selected>-- Pilih --</option>
                @foreach ($penerimaan as $p)
                    <option value="{{ $p->id }}" data-kadaluarsa="{{ $p->tanggal_kadaluarsa }}">
                        #{{ $p->id }} - {{ $p->barang->nama_barang ?? '-' }} ({{ $p->jumlah_diterima }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Lokasi Penyimpanan --}}
        <div class="mb-4">
            <label for="lokasi_penyimpanan" class="block text-sm font-medium text-gray-700">Lokasi Penyimpanan</label>
            <select name="lokasi_penyimpanan" id="lokasi_penyimpanan"
                    class="mt-1 block w-full border rounded px-3 py-2 bg-white" >
                <option value="" disabled selected>-- Pilih Gudang --</option>
                <option value="Gudang Makanan" data-kapasitas="10000">Gudang Makanan (Kapasitas: 10.000 unit)</option>
                <option value="Gudang Elektronik" data-kapasitas="8000">Gudang Elektronik (Kapasitas: 8.000 unit)</option>
                <option value="Gudang Farmasi" data-kapasitas="5000">Gudang Farmasi (Kapasitas: 5.000 unit)</option>
            </select>
        </div>

        {{-- Kapasitas Rak --}}
        <div class="mb-4">
            <label for="kapasitas_rak" class="block text-sm font-medium text-gray-700">Kapasitas Rak</label>
            <input type="number" name="kapasitas_rak" id="kapasitas_rak"
                   class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100" placeholder="Otomatis dari gudang" readonly >
        </div>

        {{-- Simulasi Kapasitas Tersisa --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Kapasitas Gudang Tersisa</label>
            <input type="text" id="kapasitas_tersisa_display"
                   class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100 text-gray-700" readonly>
        </div>

        {{-- Kategori Barang --}}
        <div class="mb-4">
            <label for="kategori_barang" class="block text-sm font-medium text-gray-700">Kategori Barang</label>
            <input type="text" name="kategori_barang" id="kategori_barang"
             class="mt-1 block w-full border rounded px-3 py-2"
             placeholder="Misal: Makanan, Elektronik"
            
            value="{{ old('kategori_barang') }}">
        </div>

        {{-- Jumlah Stok --}}
        <div class="mb-4">
            <label for="jumlah_stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
            <input type="number" name="jumlah_stok" id="jumlah_stok"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   placeholder="Jumlah yang tersedia" 
                   value="{{ old('jumlah_stok') }}">
        </div>

        {{-- Tanggal Kadaluarsa (display-only) --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
            <input type="text" id="tanggal_kadaluarsa_display"
                   class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100 text-gray-700" readonly>
        </div>

        {{-- Hidden field untuk tanggal kadaluarsa --}}
        <input type="hidden" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa">

        {{-- Tombol --}}
        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded">
                Simpan
            </button>
            <a href="{{ route('penyimpanan_barang.index') }}"
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
    document.addEventListener('DOMContentLoaded', function () {
        const lokasiSelect = document.getElementById('lokasi_penyimpanan');
        const kapasitasRakInput = document.getElementById('kapasitas_rak');
        const kapasitasDisplay = document.getElementById('kapasitas_tersisa_display');
        const jumlahStokInput = document.getElementById('jumlah_stok');
        const penerimaanSelect = document.getElementById('penerimaan_id');
        const kadaluarsaInput = document.getElementById('tanggal_kadaluarsa');
        const kadaluarsaDisplay = document.getElementById('tanggal_kadaluarsa_display');

        function updateKapasitasRak() {
            const selected = lokasiSelect.options[lokasiSelect.selectedIndex];
            const kapasitas = selected.getAttribute('data-kapasitas');
            kapasitasRakInput.value = kapasitas || '';
        }

        function updateKapasitasTersisa() {
            const selected = lokasiSelect.options[lokasiSelect.selectedIndex];
            const kapasitas = parseInt(selected.getAttribute('data-kapasitas')) || 0;
            const stok = parseInt(jumlahStokInput.value) || 0;
            const sisa = kapasitas - stok;
            kapasitasDisplay.value = sisa >= 0 ? `${sisa} unit` : 'Melebihi kapasitas!';
        }

        function updateKadaluarsa() {
            const selectedOption = penerimaanSelect.options[penerimaanSelect.selectedIndex];
            const tanggal = selectedOption.getAttribute('data-kadaluarsa') || '';
            kadaluarsaInput.value = tanggal;
            kadaluarsaDisplay.value = tanggal;
        }

        lokasiSelect.addEventListener('change', () => {
            updateKapasitasRak();
            updateKapasitasTersisa();
        });

        jumlahStokInput.addEventListener('input', updateKapasitasTersisa);
        penerimaanSelect.addEventListener('change', updateKadaluarsa);
    });
</script>
@endsection
