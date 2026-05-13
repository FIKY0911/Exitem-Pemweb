<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $category->name }} - {{ config('app.name') }}</title>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('front.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">← Back</a>
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $category->name }}</h1>

        @if($products->isEmpty())
            <p class="text-gray-500 text-sm">No products in this category yet.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($products as $product)
                    @include('front.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
