<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="{{ route('front.index') }}" class="text-xl font-bold text-indigo-600">
                {{ config('app.name') }}
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <a href="/admin" class="text-sm text-gray-600 hover:text-gray-900">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('front.index') }}" class="text-sm text-indigo-600 hover:underline mb-6 inline-block">← Back</a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden md:flex">
            @if($product->thumbnail)
                <img src="{{ Storage::url($product->thumbnail) }}"
                     class="w-full md:w-80 h-64 md:h-auto object-cover"
                     alt="{{ $product->name }}">
            @else
                <div class="w-full md:w-80 h-64 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
            @endif

            <div class="p-6 flex flex-col justify-between flex-1">
                <div>
                    <p class="text-xs text-indigo-500 font-medium mb-1">
                        {{ $product->category->name ?? '-' }} &bull; {{ $product->brand->name ?? '-' }}
                    </p>
                    <h1 class="text-2xl font-bold text-gray-900 mb-3">{{ $product->name }}</h1>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $product->about }}</p>
                    <p class="text-sm text-gray-500">Stock: <span class="font-medium text-gray-700">{{ $product->stock }}</span></p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    <form action="{{ route('front.save_order', $product->slug) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                            Order Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
