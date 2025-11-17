@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-[#0b1d3a] rounded-lg text-white">

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Confirmar Pedido</h1>

    <ul class="space-y-3">
        @php $total = 0; @endphp

        @foreach($cart as $item)
            @php $total += $item['price'] * $item['quantity']; @endphp

            <li class="border-b border-gray-700 pb-2">
                {{ $item['quantity'] }}x {{ $item['name'] }}
                <span class="text-yellow-400 font-bold float-right">
                    R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
                </span>
            </li>
        @endforeach
    </ul>

    <div class="text-right mt-6 text-xl">
        Total:
        <span class="text-yellow-400 font-bold">
            R$ {{ number_format($total, 2, ',', '.') }}
        </span>
    </div>

    <form action="{{ route('checkout.finish') }}" method="POST" class="mt-6">
        @csrf
        <button class="bg-yellow-400 text-black px-5 py-2 font-bold rounded hover:bg-yellow-300">
            Finalizar Compra
        </button>
    </form>

</div>
@endsection
