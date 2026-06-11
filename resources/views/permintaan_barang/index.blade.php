<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"
        x-transition
        class="fixed top-10 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50"
    >
        {{ session('success') }}
    </div>
@endif

<body class="bg-gray-100 font-poppins">
    <div class="flex h-screen">
        @include('layouts.sidebar')
  @php
    $allowedEmails = ['permintaan@gudang.com', 'manager@gudang.com'];
    $isAllowed = in_array(auth()->user()->email, $allowedEmails);
@endphp

        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Header -->
            <header class="flex items-center justify-between bg-white shadow px-6 py-4">
                <h1 class="text-lg font-semibold">Permintaan Barang</h1>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gray-100 px-3 py-1 rounded-md hover:bg-gray-200">
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm hover:bg-gray-100 text-left">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6 w-full">
                <div class="max-w-6xl mx-auto">
                                    <!-- Filter -->
<div class="flex justify-between items-center mb-4">
    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('permintaan_barang.index') }}" class="relative w-full max-w-sm">
        <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
            class="w-full pl-10 pr-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
            </svg>
        </div>
    </form>
@if($isAllowed)
                        <a href="{{ route('permintaan_barang.create') }}"
                           class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Tambah Permintaan Barang
                        </a>
                        @endif
                    </div>

                    <!-- Table -->
                    <div class="bg-white rounded-lg shadow overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">Kode Barang</th>
                                    <th class="px-4 py-2">Nama Barang Diminta</th>
                                    <th class="px-4 py-2">Kategori Barang</th>
                                    <th class="px-4 py-2">Jumlah Barang Diminta</th>
                                    <th class="px-4 py-2">Tujuan Pengiriman</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permintaan as $index => $item)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">{{ $item->penyimpanan->penerimaan->barang->kode_barang ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $item->penyimpanan->penerimaan->barang->nama_barang ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $item->penyimpanan->penerimaan->barang->jenis_barang ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $item->jumlah_barang_diminta }}</td>
                                        <td class="px-4 py-2">{{ $item->tujuan_pengiriman }}</td>
                                        <td class="px-4 py-2">
    @if ($item->status_permintaan === 'pending')
        <span class="text-yellow-600 font-semibold">Pending</span>
    @elseif ($item->status_permintaan === 'diproses')
        <span class="text-green-600 font-semibold">Diproses</span>
    @elseif ($item->status_permintaan === 'ditolak')
        <span class="text-red-600 font-semibold">Ditolak</span>
    @else
        <span class="text-yellow-500">Pending</span>
    @endif
</td>


                                        </td>
                                        <td class="px-4 py-2 flex items-center space-x-2">
                                            <!-- Edit -->
                                            @if($isAllowed)
                                            <a href="{{ route('permintaan_barang.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                                              <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect x="0.222168" width="17" height="17" fill="url(#pattern0_284_1087)"/>
<defs>
<pattern id="pattern0_284_1087" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_284_1087" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_284_1087" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACF0lEQVR4nO3cv0rdYBiA8cdBb8YqgpPYoegmXoD34GaRLkK/rVJQcBBHFbVLZzdXR72DQmnr0D9Lx/4BJRChSJRzTpI3PfmeH2Q8mjy8nnw5JxEkSZIkSf+1OeAEuAF+A1+AI+BZ1zvWJy+Bv8BtxfYHWO96B/sgPRL44bbV9Y7mEPnW2HGRjR0Y2diBkY0dGNnYgZHvN5d+QaGLdfb0w1+Wu9RS7MOuDyyX2J+6PqhcYv/q+oByif2564PJJfYxGYZLI7ymTuTiU79ZMpL+OfjI2BtkJFUE2B7yZ7waIfJrMpKeCNFmbCPTfmwj0/5kG5n2YxuZ9mMbmeFWCqMs/YZ9zVhLNS8s6kx2NlKDkY0d/Bmykx0U2diBkbOPnQIjZxs7dRC52FwnY2Qnedwk3y6M3AvJSTZyLyQn2ci9kJxkI/dCcpKN3AtOcgAjBzByACMHMHIAIwcwcoBJYB5YBjbLB2civn5KZG7ByHETXjy26yQH+OEtATE+eN9FjCtPfDEuvIMoxntv04qx4zo5xpIXI/XNDHhV9gJ4C5wB58AlcF2uSJ5a/mV/xXfvTUNBpoGfRq42AXxscPp2neRqzxv+U1/z7aLaQcOPJSzndqf9oB8WfW/4JDbVwn6OvVUfuInxzqebYnzzUbIYNwP+R8O98qstjWj7kbjFCXIfWCzX2appqoxdTPZX4BRYKVcjkiRJkiTG2B2vTLDs0kESkAAAAABJRU5ErkJggg=="/>
</defs>
</svg>          
</a>
                                            <!-- Hapus -->
                                            <button onclick="openModal({{ $item->id }})" class="text-red-600 hover:text-red-800"> <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect x="0.222168" width="17" height="17" fill="url(#pattern0_284_1088)"/>
<defs>
<pattern id="pattern0_284_1088" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_284_1088" transform="scale(0.0111111)"/>
</pattern>
<image id="image0_284_1088" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACYElEQVR4nO3cPW4TYRjE8T+BBopcAAyiDydIKKAkXABzAUJFaDANEk2o+TDQE1oozAlMA3ThBEkHDYmCQCIuHrTSIlHwEYc33pmX5yeNFLnyjqVda8dZSCmllFJKqTNngdU2Z/JzOBzngc9AtGn+Xsyyy3v3U8k/8iaLLu/bL4puXkuFxW+S2nPoW2DvD0V1nb32FGR7vm++FewKFBn7zK7rN5mbAuXFlLmBqBPAENgRKCkOKdvAI+B4l0U/FSgiZpTmWDsxB3wVKCBmlC/tMWfRVFr0/3bqeEKHmgvEw/aCEZXmE/Cg64thSimllNLs1Xi/YwdB7wWKicLZQNArgWKicEYIeixQTBROcwtYzm2BYqJwBgi6KlBMFE4f0R+4RGVZQtBpgWKicHoIOgpMBMqJQmmO5RiitgQKikLZRNhrgYKiUMYIey5QUBTKOsLuCRQUhbKGsOsCBUWhrCDsskBBUSjLCDsnUFAUygLC5gUKikJpjkVaDQPANgZqGAA2MFDDADDCQA0DwBADNQwAAwzUMAD0MbAkUFT8Yyz+Q6uGAaCHAfcBYKJ8w7+mAWATI84DwBgjzgPAOkacB4A1jKwIFBYHzDWMLAsUFgfMJYw4DwALGHEeAOYx4zgAbGPIcQDYwJDjADDCkOMAMMTQQKC4mDK3MNQXKC6mzBUMOQ4AixhyHAB6GHIbACZON/ydB4BNjDkNAGOMPRMoMPaZ5r3acnps5irGTok/aTfaNO/xJObuChT5t9yhAnPts/FCNPeBI1TkIvAS+ChQ7gfgBXCh61JSSimllFJKKaWUMPQdPaFziuEZeyUAAAAASUVORK5CYII="/>
</defs>
</svg></button>

                                            <!-- Modal -->
                                            <div id="modal-{{ $item->id }}" class="fixed z-50 inset-0 bg-black bg-opacity-30 hidden justify-center items-center">
                                                <div class="bg-white p-6 rounded shadow-md max-w-md w-full">
                                                    <h2 class="text-lg font-semibold mb-2">Konfirmasi Hapus</h2>
                                                    <p>Apakah kamu yakin ingin menghapus data ini?</p>
                                                    <div class="flex justify-end mt-4 gap-2">
                                                        <button onclick="closeModal({{ $item->id }})" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                                        <form method="POST" action="{{ route('permintaan_barang.destroy', $item->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
 @if(session('search_success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Data Ditemukan',
            text: 'Hasil pencarian untuk: {{ session("search_success") }}',
        });
    });
</script>
@endif

@if (session('search_not_found'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'error',
            title: 'Tidak Ditemukan',
            text: 'Tidak ada hasil untuk: {{ session("search_not_found") }}',
        });
    });
</script>
@endif
    <!-- Script -->
    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        }

        function openModal(id) {
            document.getElementById(`modal-${id}`).classList.remove('hidden');
            document.getElementById(`modal-${id}`).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(`modal-${id}`).classList.add('hidden');
            document.getElementById(`modal-${id}`).classList.remove('flex');
        }
    </script>
</body>
</html>
