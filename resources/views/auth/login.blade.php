<x-guest-layout>
    <div class="w-full max-w-md relative">
        <!-- Card bayangan -->
        <div class="absolute inset-0 translate-x-2 translate-y-2 bg-gray-300 rounded-2xl opacity-80 pointer-events-none"></div>

        <!-- Card putih -->
        <div class="relative bg-white rounded-2xl p-8 shadow-sm">
            <!-- Logo (diperbesar) -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/inventra.png') }}" alt="Logo" class="h-20">
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

<!-- Email -->
<div class="relative">
    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
        <!-- User Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A9.975 9.975 0 0112 15c2.21 0 4.236.72 5.879 1.925M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    </span>
    <input
        type="email"
        name="email"
        id="email"
        value="{{ old('email') }}"
        required
        autofocus
        placeholder="Email"
        class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-full text-sm focus:ring-2 focus:ring-sky-300 focus:outline-none"
    >
    @error('email')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Password -->
<div class="relative">
    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
        <svg class="h-4 w-4" viewBox="0 0 22 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 4H11.65C11.2381 2.83048 10.4733 1.81762 9.46134 1.10116C8.44934 0.384703 7.23994 -4.57935e-05 6 4.08807e-09C2.69 4.08807e-09 0 2.69 0 6C0 9.31 2.69 12 6 12C7.23994 12 8.44934 11.6153 9.46134 10.8988C10.4733 10.1824 11.2381 9.16952 11.65 8H12L14 10L16 8L18 10L22 5.96L20 4ZM6 9C4.35 9 3 7.65 3 6C3 4.35 4.35 3 6 3C7.65 3 9 4.35 9 6C9 7.65 7.65 9 6 9Z"/>
        </svg>
    </span>
    <input
        type="password"
        name="password"
        id="password"
        required
        placeholder="Password"
        class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-full text-sm focus:ring-2 focus:ring-sky-300 focus:outline-none"
    >
</div>


                <!-- Remember / Forgot -->
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="rounded text-sky-500 focus:ring-sky-400">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="hover:underline">Forgot your password?</a>
                    @endif
                </div>

                <!-- Tombol LOGIN (kanan) -->
                <div class="flex justify-end pt-2">
                    <button
                        type="submit"
                        class="px-10 py-2 bg-sky-300 text-white font-semibold rounded-full hover:bg-sky-400 focus:ring-2 focus:ring-sky-200">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
