@extends('layouts.app')

@section('title', "Pedido #{$order->id}")

@section('content')
<div class="max-w-4xl mx-auto mt-10 text-white">
    <a href="{{ route('admin.orders.index') }}" class="text-yellow-400 font-bold hover:underline mb-4 inline-block">Voltar</a>

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">
        Pedido #{{ $order->id }}
    </h1>

    <div class="bg-[#0b1d3a] p-6 rounded-lg shadow mb-8">
        <p><strong>Cliente:</strong> {{ $order->user->full_name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
        <p><strong>Data:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p class="mt-2 text-yellow-400 text-xl font-bold">
            Total: R$ {{ number_format($order->total, 2, ',', '.') }}
        </p>
    </div>

    <h2 class="text-xl font-bold text-yellow-400 mb-3">Itens</h2>

    <div class="bg-[#0b1d3a] p-6 rounded-lg shadow">
        @foreach($order->items as $item)
        <div class="flex justify-between border-b border-gray-700 py-3">
            <div>
                <p class="font-bold">{{ $item->product->name }}</p>
                <p>Qtd: {{ $item->quantity }}</p>
            </div>

            <p class="text-yellow-400">
                R$ {{ number_format($item->unit_price, 2, ',', '.') }}
            </p>
        </div>
        @endforeach
    </div>

</div>
@endsection
