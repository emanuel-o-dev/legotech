@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
<div class="max-w-3xl mx-auto mt-10">

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Seu Carrinho</h1>

    @if(session('success'))
        <div class="p-3 bg-green-600 text-white rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="p-3 bg-red-600 text-white rounded mb-4">{{ session('error') }}</div>
    @endif

    @if(count($cart) === 0)
        <p class="text-white">Nenhum item no carrinho.</p>
    @else

        <div class="bg-[#0b1d3a] p-6 rounded shadow-md text-white">

            @php $total = 0; @endphp

            @foreach($cart as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp

                <div class="flex items-center justify-between border-b border-gray-700 py-4">

                    <img src="{{ asset('storage/' . $item['image']) }}" 
                         class="w-20 rounded shadow">

                    <div>
                        <p class="font-bold">{{ $item['name'] }}</p>
                        <p>R$ {{ number_format($item['price'], 2, ',', '.') }}</p>
                        <p class="text-sm opacity-70">Qtd: {{ $item['quantity'] }}</p>
                    </div>

                    <div class="flex gap-2">

                        <form method="POST" action="{{ route('cart.decrease', $item['id']) }}">
                            @csrf
                            <button class="bg-yellow-400 px-3 py-1 rounded font-bold">-</button>
                        </form>

                        <form method="POST" action="{{ route('cart.add', $item['id']) }}">
                            @csrf
                            <button class="bg-yellow-400 px-3 py-1 rounded font-bold">+</button>
                        </form>

                        <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                            @csrf
                            <button class="bg-red-600 px-3 py-1 rounded font-bold">X</button>
                        </form>

                    </div>

                </div>
            @endforeach

            <div class="text-right mt-6 text-yellow-400 font-bold text-xl">
                Total: R$ {{ number_format($total, 2, ',', '.') }}
            </div>

            <div class="text-right mt-4">
                <a href="{{ route('checkout.index') }}"
                   class="bg-yellow-400 text-black px-4 py-2 rounded font-bold hover:bg-yellow-300">
                    Finalizar compra
                </a>
            </div>

        </div>

    @endif

</div>
@endsection
