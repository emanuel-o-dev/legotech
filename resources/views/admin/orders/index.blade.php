@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <a href="{{ route('admin.dashboard') }}" class="text-yellow-400 font-bold hover:underline mb-4 inline-block">Voltar</a>

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Pedidos</h1>

    <div class="bg-[#0b1d3a] p-6 rounded-lg shadow text-white">

        <table class="table w-full">
            <thead class="text-yellow-400">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Data</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->full_name }}</td>
                    <td>R$ {{ number_format($order->total,2,',','.') }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="text-yellow-400 font-bold hover:underline">
                           Ver Detalhes
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">{{ $orders->links() }}</div>
    </div>
</div>
@endsection
