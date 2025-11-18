<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'))->with('success', 'Produto criado com sucesso!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'specs'       => 'nullable|string', // JSON
            'image'       => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['name','description','price','category_id']);

        // Upload da imagem
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        // Specs JSON
        if ($request->specs) {
            $data['specs'] = json_decode($request->specs, true);
        }

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'specs'       => 'nullable|string',
            'image'       => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['name','description','price','category_id']);

        // Upload de nova imagem (se houver)
        if ($request->hasFile('image')) {
            // remove imagem antiga
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        // Specs
        if ($request->specs) {
            $data['specs'] = json_decode($request->specs, true);
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        // remove imagem
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto removido com sucesso!');
    }
}
