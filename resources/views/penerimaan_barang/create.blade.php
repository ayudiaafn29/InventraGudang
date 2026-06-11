@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Tambah Penerimaan Barang</h1>
        <form action="{{ route('penerimaan_barang.store') }}" method="POST">
            @csrf

            {{-- Kode Barang (readonly) --}}
            <div class="mb-4">
                <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
                <input type="text" name="kode_barang" value="{{ $nextKode }}"
                       class="mt-1 block w-full border rounded px-3 py-2 bg-gray-100 text-gray-700" readonly>
            </div>

            {{-- Nama Barang --}}
            <div class="mb-4">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang"
                       class="mt-1 block w-full border rounded px-3 py-2" placeholder="Tulis nama barang">
            </div>

             {{-- Jenis Barang --}}
            <div class="mb-4">
    <label for="jenis_barang" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
    <input type="text" name="jenis_barang" id="jenis_barang" class="mt-1 block w-full border rounded p-2">
</div>


            {{-- Supplier --}}
            <div class="mb-4">
                <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                <select name="supplier_id" id="supplier_id"
                        class="mt-1 block w-full border rounded px-3 py-2 bg-white">
                    <option value="" disabled selected>Pilih supplier</option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->nama_supplier }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah Diterima --}}
            <div class="mb-4">
                <label for="jumlah_diterima" class="block text-sm font-medium text-gray-700">Jumlah Diterima</label>
                <div class="flex">
                    <input type="number" name="jumlah_diterima"
                           class="w-full border rounded-l px-3 py-2" min="1">
                    <span class="inline-flex items-center px-3 bg-gray-200 border border-l-0 rounded-r text-sm">
                        unit
                    </span>
                </div>
            </div>

            {{-- Tanggal Masuk --}}
            <div class="mb-6">
                <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                       value="{{ old('tanggal_masuk') }}"
                       class="mt-1 block w-full border rounded px-3 py-2">
                @error('tanggal_masuk')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Masuk --}}
            <div class="mb-6">
                <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa"
                       value="{{ old('tanggal_kadaluarsa') }}"
                       class="mt-1 block w-full border rounded px-3 py-2">
                @error('tanggal_masuk')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Tombol Simpan --}}
            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded">
                    Simpan
                </button>
                <a href="{{ route('penerimaan_barang.index') }}"
               class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded">
                Kembali
            </a>
            </div>
        </form>
    </div>
    @if ($errors->has('nama_barang'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Input Tidak Valid',
            text: '{{ $errors->first('nama_barang') }}',
            confirmButtonColor: '#3085d6',
        });
    </script>
@endif

{{-- Popup untuk jenis_barang --}}
@if ($errors->has('jenis_barang'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Input Tidak Valid',
            text: '{{ $errors->first('jenis_barang') }}',
            confirmButtonColor: '#3085d6',
        });
    </script>
@endif
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Form Tidak Valid',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
        });
    </script>
@endif

@endsection
