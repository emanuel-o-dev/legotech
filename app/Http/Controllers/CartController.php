<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image_path,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return back()->with('error', 'Item removido.');
    }

    public function decrease(Product $product)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return back()->with('error', 'Item não encontrado no carrinho.');
        }

        if ($cart[$product->id]['quantity'] > 1) {
            $cart[$product->id]['quantity']--;
            return back()->with('error', 'Item removido.');
        } else {
            unset($cart[$product->id]);
            return back()->with('error', 'Item removido.');
        }

        session()->put('cart', $cart);

        return back()->with('error', 'Quantidade atualizada.');
    }
}
