<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $products = Product::orderBy('id', 'desc')->paginate(12);

        return view('products.index', compact('categories', 'products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
