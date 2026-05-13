<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $popularProducts = Product::where('is_popular', true)->with(['category', 'brand'])->get();
        $latestProducts = Product::latest()->with(['category', 'brand'])->take(8)->get();

        return view('front.index', compact('categories', 'popularProducts', 'latestProducts'));
    }

    public function details(Product $product)
    {
        $product->load(['category', 'brand']);

        return view('front.details', compact('product'));
    }

    public function category(Category $category)
    {
        $products = $category->products()->with(['brand'])->get();

        return view('front.category', compact('category', 'products'));
    }
}
