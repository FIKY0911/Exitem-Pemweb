d<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">
                {{ config('app.name') }}
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('profile') }}" class="text-sm text-gray-600 hover:text-gray-900">Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 hover:underline">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600 text-lg">Ini adalah halaman depan Anda. Jelajahi produk-produk kami dan mulai berbelanja.</p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="/browse" class="bg-indigo-50 border border-indigo-200 rounded-xl p-6 text-center hover:bg-indigo-100 transition">
                    <h3 class="text-indigo-700 font-semibold text-lg">Jelajahi Produk</h3>
                    <p class="text-indigo-500 text-sm mt-1">Lihat semua produk yang tersedia</p>
                </a>
                <a href="/order/booking/" class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center hover:bg-amber-100 transition">
                    <h3 class="text-amber-700 font-semibold text-lg">Pesanan Saya</h3>
                    <p class="text-amber-500 text-sm mt-1">Cek status pesanan Anda</p>
                </a>
                <a href="/profile" class="bg-green-50 border border-green-200 rounded-xl p-6 text-center hover:bg-green-100 transition">
                    <h3 class="text-green-700 font-semibold text-lg">Profil Saya</h3>
                    <p class="text-green-500 text-sm mt-1">Kelola akun dan pengaturan</p>
                </a>
            </div>
        </div>
    </div>

</body>
</html>
