<a href="{{ route('front.details', $product->slug) }}"
   class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition group">
    @if($product->thumbnail)
        <img src="{{ Storage::url($product->thumbnail) }}"
             class="w-full h-40 object-cover group-hover:scale-105 transition duration-300"
             alt="{{ $product->name }}">
    @else
        <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">No Image</div>
    @endif
    <div class="p-3">
        <p class="text-xs text-indigo-500 font-medium mb-1">{{ $product->category->name ?? '-' }}</p>
        <h3 class="text-sm font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
        <p class="text-sm text-gray-600 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    </div>
</a>
