<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-poppins">

    <div class="flex h-screen">
    {{-- Sidebar --}}
    @include('layouts.sidebar')
        <!-- Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Topbar -->
            <header class="flex items-center justify-between bg-white shadow px-6 py-4">
                <!-- Logo + Title -->
                <div class="flex items-center space-x-3">
                    <h1 class="text-lg font-semibold">Inventra Dashboard</h1>
                </div>
                
                <!-- Dropdown User -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gray-100 px-3 py-1 rounded-md hover:bg-gray-200 focus:outline-none">
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md overflow-hidden z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6 w-full">
                <!-- Container to limit width so cards not too long -->
                <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center h-36">
    <div>
        <h2 class="text-sm text-gray-500">Jumlah Penyimpanan</h2>
            <p class="text-2xl font-bold mt-2">{{ number_format($jumlahPenyimpanan) }}</p>
            <p class="text-green-500 text-sm">
    {{ $kenaikanPenyimpanan >= 0 ? '+' : '' }}{{ round($kenaikanPenyimpanan, 2) }}% {{ $kenaikanPenyimpanan >= 0 ? 'Kenaikan' : 'Penurunan' }}
</p>

    </div>
    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100">
        <svg class="w-8 h-8" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="50" height="50" fill="url(#pattern0_285_508)"/>
            <defs>
                <pattern id="pattern0_285_508" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_285_508" transform="scale(0.0111111)"/>
                </pattern>
                <image id="image0_285_508" width="90" height="90" preserveAspectRatio="none"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEW0lEQVR4nO2dS4gcZRDHP19o4kE9KHr2AR4EIb4FV8HsVPVGg8gQQcWT3hSWDU5Vb2AQPCteRW8+IyTBoyIBHznosF01uyoGND4IooZgYnwlJi3fZrKO0Z6dme7tr6e3/lCnYXr+/Zvq+r7urq/bOZPJZKq+mrP7NiDLs8h6AFlOIWtaYhxE1hdmqHuZq7Pgyf0XIsn7JcP9b5B+urWdXOrqKmCdDQ55BbY85+oqIPmoQqC/dXUVkn4VHHAvgOSkq6uA9OvQgPvDrW/Q8h20kgc2z8kVfnYwSjTizlXAySPIcshA82qgkzvz/qHYkgcNNA8aoPSIc+k5eUFvnpOLDTQPzOifXQGaah+4yEDz4NIRxcmNeUFHJGCgeZVpF8tnQAs3j1NCms2d5zVayd3A8o2B5mHnuforsBweLfQ3m945m0eXJrATFgNdK4FltIGulcAy2kDXSmAZbaBrJbCMNtC1ElhGG+haCSyjDXStBJbRBrpWAtL9oZtm/n3HvabCKnSS9t2bdHUVsjwfGvA/9yTlRVdXAXenqgM6mXZ1FrLuDQ0ZWT8ooiOq0sKW3oAkv4SDLIeQ5Dq3HtSIkxnftxEA9A8Q621uPWmGupuQRcqpx3ISSd6Kti9d6daj2u30XN9iC6xvLK8GIPm9ILjH/QosIP0QSZ+Jnl68PvS+mkwmk8lkMlVk+gUsDyHrLmT9GFg6ZQT63yLZDdR92HsYptM/InkUWPYAySdl+ez91h6/5G4Yn5nmkWVnuFNlPRO7ptp7z8/y6T9D0rdD+/SJMchnphokT4U2jyshc1k+gbqt8P5WYG8fGXRZp8eY8yI9sH4R2t9KkHw+OuigV9j0rB3QE9k+9cQk+BwEuqjrDmkRkemzAt6G8ZkLNLB83yC93z++Z9TtN2f3bfDf9dtYa9C9ZXGP39vqXDKOT4jlvrw+c4H2oFxORS3dWkJGx3l9etjBQI+TyWdrS7uzca1BT8fJLa6Qh24Z6HQQhIjk1okGPSmlA0jn8/r0+xoMtB8gPCh/+I+6/S3tzkb/3UkYDIsYtDNl0zsdZpA10BgoLKPZQKdrXaMtozn/IRkarJUONtBpkZkSOoMto9lAp5bRdsKSWunIUOiabDWaDXRqNbr/kLR7hqmVjj6FrslWo9lAp1aj+w9Jq9FpSaVDj4Sud9gLYDma5RNI/pwEn27Se9pgyIdyh/aZKSR9vTo7oC9lgibZXSGfL48MGqjbDG6cV18g7xvQQ/s7E41YGmM2outSaPPA+t4gn5ue6FxQkQeujL+QP5pfvANZ/ghmnvTHaVq6ZlWfnNzTWy0bKhl+yr2QH0m2BYJ9EOPuTcP6BNLHQsD2jTVF9PYtq0Hd24F0saTs+AtZXgFeuHxUn1FL7/Ijf4k+X/Pv9HJFarlm+wXyJK8uvyuF5WhBpo8By5dA8g6SMMwvXp3H5+nFQ7INSN/sQT9WlM/TrwmUd30v38yOhWuLo2symUzu//Q3BJqEpUg988wAAAAASUVORK5CYII="/>
            </defs>
        </svg>
    </div>
</div>

                    <!-- Card 2 -->
                   <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center h-36">
    <div>
        <h2 class="text-sm text-gray-500">Permintaan Hari Ini</h2>
            <p class="text-2xl font-bold mt-2">{{ $permintaanHariIni }}</p>
            <p class="text-yellow-500 text-sm">+{{ $permintaanHariIni }} Telah Dibuat</p>
    </div>
    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-red-100">
        <svg class="w-8 h-8" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="50" height="50" fill="url(#pattern0_285_511)"/>
            <defs>
                <pattern id="pattern0_285_511" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_285_511" transform="scale(0.0111111)"/>
                </pattern>
                <image id="image0_285_511" width="90" height="90" preserveAspectRatio="none"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACgElEQVR4nO3dsW4TQRAG4K2ARwDCc1BRUFHRUqdLtHM7ARqg4+kShBTrdk6paHgGFBBQGW2UJlYUwGf73xn/vzR1Ll9G//n2pDglhmEYhmEYN/l6ePjAhvzaVD5byd9NZYmaWuR3LXI6luOnKVJM9UktYkhcuw1c5eeo+UWKssk9Ils07Ou6gINadOyrTu4A06JjV82XaES7OT9CYncAu7yBeSLP7vrj15J/1WF4mbwFDWsr064pJHaP0CGxe4UOh90zdCjs3qHDYHuADoHtBdo9tido19jeoN1ie4R2ie0V2h22Z2hX2N6h3WBHgG4Zh+H5X49Yke8g0bC2MotheLw17CKnCRU0rK3MpPn9nN/nLuz2dj2hgoa1WzAa9rY2O6GChrUdD6GV0PAtNG60wOFYHYpHZUcroeEbZ9xogSOxOhQPyI7WvoYPLEpo+BYaN1rgcKwOxaOyo5XQ/3RebCW/m3NePDftZ7cz66tribrR08w3IJtMu5aw0Odvjh6lTnIh8jAs9AJYGasZ3x4fhIWeOqqOWuRDWOi6gZenc7MXN0NzPoRWQsO30LjRAodjdSgelR2thO7qrGMx42Oc+42eAA8s65xpuIc+B5x1rHOm4R56AXgiXOdMwz30BKiOdc403EPXHZ517PXN0JwPoZXQ8C00brTA4VgdikdlRyuh4Rtn3GiBI7E6FA/Ijta+hg8sSmj4Fho3WuBwrA7Fo7KjdQ+hO/zX88utTcnfkJ86XHyZgm1gapFPMOha5AQNYDuaqUiBQX9RvV81VzSCbXtKHi8+vrqX4F/hFBm75LG9SU895HqztfVYhBtk1XxZNZ+1uoBvMsMwDMMwTPqf/AFW5LmQOAlilwAAAABJRU5ErkJggg=="/>
            </defs>
        </svg>
    </div>
</div>


                    <!-- Card 3 -->
                    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center h-36">
    <div>
        <h2 class="text-sm text-gray-500">Pengiriman Hari Ini</h2>
            <p class="text-2xl font-bold mt-2">{{ $pengirimanHariIni }}</p>
            <p class="text-blue-500 text-sm">
    {{ $sedangDikirim > 0 ? $sedangDikirim . ' Sedang Dikirim' : 'Tidak ada pengiriman aktif' }}
</p>

    </div>
    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100">
        <svg class="w-8 h-8" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="50" height="50" fill="url(#pattern0_285_510)"/>
            <defs>
                <pattern id="pattern0_285_510" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_285_510" transform="scale(0.0111111)"/>
                </pattern>
                <image id="image0_285_510" width="90" height="90" preserveAspectRatio="none"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADFUlEQVR4nO2cy2oUURCGz0aj7kW8grrTpZelICLkBYJzaqLugpsogplTMzEEfAQvmKy8TFUHBtcBfQAvO0WfQRAlCkkEL2HkJOpCMgmZmZ463f4fHAYCHf7++u/q6YRu5wAAAAAAAAAAAAAAAAD8y/SDyzuC+mss9IrVL7FSO93ll4LQSxa6Oj4/PFSYo1lrVg8EoTf2Aqkb6a9jfleIJhdWMv2VnXyzV8eFuSjqeYWsMu5SZm0m24vi3lv9wqVMEFosRaOFFl3KWAviPi6XMtZyGKLtxTEabS+VMTogel2sW8hotL04tl8L8fs5C12Jd9CuFxLYmXYRVlD/dnLuwkGI1gEIF3o33RrZjkbrQJo9AdE6iDHiP3T1l0Lr2ccFXCGrjEK0dilP6FtdqDaRVfb19O0CjabNZAeXJ9anISeyGs3qXojW/EXnKhmNJojmAY8ONFoh2vwCxmi0vTiMDrWXihmtEG3eOEaj7SUxRgeZC8SM1rQWbli0JAfMOhiXbEG0QnTbuoVotNqLw+hQe6mY0QrRbevGodFqLwmjQ+0FYkZrWgs3LArRbesWotFqLw6jQwswo6dnx3YFoXss9KXXX7z6iLNQffLx6OGx2bFt8TOob6T/zo988gf1n1n93eutkZ3xQfuZvoVUOrHelXYiq5xMXXau+YVmouivfQkrVN/oPxNB6Ka1TKv8Qf1y30TH02yjoDfmLhw1l2mU/4/ovoyOzZ5QGp8fHrKWaZU/qL/v4qAOQnfWBneajeABrJzyL7DQ7dWL4VZhoWcdjlpjw+3UT3XY7qkbIIXJ3/mi4Je4WT213jY19afjnOpmB//b/PEUY6GfncL+3pEjceatnW5+qmNIoR/h0cVDuQQtQ/4glPVlNgo1cwtZhvz11sju+NRojyE/1rPKnlyDliF/Xehst9/Bg/rlIHQm95BlyV/LKueD+k9bbkKzes4lQKHyx3eBstCToH5lkxassFKr8fDSfpcQhctfyyrHg9Ct+JaWoP49q/8eP4PQ8/jzerN6zCVM0fMDAAAAAAAAAAAAuAHyC89n4X15DsNrAAAAAElFTkSuQmCC"/>
            </defs>
        </svg>
    </div>
</div>


                    <!-- Card 4 -->
                    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center h-36">
    <div>
       <h2 class="text-sm text-gray-500">Kapasitas Penyimpanan</h2>
            <p class="text-2xl font-bold mt-2">{{ round($persentaseTerpakai, 2) }}%</p>
            <p class="text-red-500 text-sm">{{ round($sisaKapasitas, 2) }}% Tersedia</p>
    </div>
    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-yellow-100">
        <svg class="w-8 h-8" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="50" height="50" fill="url(#pattern0_285_513)"/>
            <defs>
                <pattern id="pattern0_285_513" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_285_513" transform="scale(0.0111111)"/>
                </pattern>
                <image id="image0_285_513" width="90" height="90" preserveAspectRatio="none"
                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAChklEQVR4nO2cvYpUQRCFW0TFwFQUxVQjDYxMjHyFfYWNXEV07dpNNNNX8BWMNzNXhIUVWZyqVRMjE0GZv64L2tKKmRem5872z/T5oGBggnv7m+KcmWCuMQAAAAAAAAAAAAAgKZMPuxcdk3VMbx3b6d8Jr8mG9/BxDMD7jZNzoTsq9NIJdSrk/zeO7U9leqVMG35/8xSkL4gbbV9VoefK9muf3F7pQt8c0wsVe2PR6zWF//LgbNjIsJmO6Ves4B7p+53Qph9tnzOt043oZthAJ3a8Crk90TIP8RNiyHtzwrTC5PDRBTey953Q++OS2z9WVOzT2Wd7xbRcbJpo1q5AhxSbppL+r0B557ppvdg0nfTyCzRFsWm6aCmrQPMWG613gZZWbLpuBVpDsWnNBep455oy7eU+nJY6THvB0SDJ3Ue65YQm2Q8jZY9jmnViby8lefzp4XnH9D33IbSSCa6Cs2jRf/K4gANoXfMsWvR6f2WjYxnH9C5eNNMs941rZROcRYvOfdNa6UC0QLTPvYXYaMkvDtEh+aUiowWife6Nw0ZLfkmIDskvEBktZQ1+sAhE+9xbiI2W/OIQHZJfalEZbSpBIToNEJ0IiE4ERCcCohNRvejWxkA0QbQWsInYaMkvD9Eh+cUio6Ux0aYSFKLTANGJgOhEQHQiIDoR1YtubQxEE0RrAZuIjZb88hAdkl8sMloqEb2q526YStAVnNWx/RF94fCkRIimSNH0Jl600D2IpijRc6G70aL90daZ8JdbRActGhsH/vDJabMM06PHl4fKNpWgw7L5YCq7lwbdQNjsuditkD/LFKSpBI2VK3bs2L4OcbH0JgMAAAAAAAAAAAAAAIBpht9coIe10flOcwAAAABJRU5ErkJggg=="/>
            </defs>
        </svg>
    </div>
</div>


    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        }
    </script>
</body>
</html>
