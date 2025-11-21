<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $selectedCategory = request('category');

        $categories = Category::orderBy('name')->get();

        $products = Product::query()
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                $query->where('category_id', $selectedCategory);
            })
            ->orderBy('id', 'desc')
            ->paginate(12)
            ->withQueryString();
        return view('products.index', compact('products', 'categories', 'selectedCategory'));
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
