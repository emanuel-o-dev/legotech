<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Seu carrinho está vazio.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function finish()
    {
        $cart = session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Carrinho vazio.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $userId = auth()->id();

        $order = Order::create([
            'user_id' => $userId,
            'total'   => $total
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id' => $item['id'],
                'unit_price' => $item['price'],
                'quantity'  => $item['quantity']
            ]);
        }

        session()->forget('cart');

        return back()->with('success', 'Produto adicionado ao carrinho!');

    }
}
