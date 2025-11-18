<?php

namespace App\Http\Controllers;

use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Verifica se o pedido pertence ao usuário autenticado
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }

        return view('user.orders.show', compact('order'));
    }
}
