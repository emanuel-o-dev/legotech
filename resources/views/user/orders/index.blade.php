@extends('layouts.app')

@section('title', 'Minhas Compras')

@section('content')
<div class="max-w-5xl mx-auto mt-10 text-white">

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Minhas Compras</h1>

    <div class="bg-[#0b1d3a] p-6 rounded-lg shadow">

        @if($orders->isEmpty())
            <p class="opacity-80">Você ainda não fez compras.</p>
        @else
        <ul>
            @foreach($orders as $order)
                <li class="border-b border-gray-700 py-4 flex justify-between">
                    <div>
                        <p class="font-bold">Pedido #{{ $order->id }}</p>
                        <p>Total: R$ {{ number_format($order->total,2,',','.') }}</p>
                    </div>

                    <a href="{{ route('user.orders.show', $order) }}"
                       class="text-yellow-400 font-bold hover:underline">
                       Ver Detalhes
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-6">{{ $orders->links() }}</div>
        @endif

    </div>

</div>
@endsection
