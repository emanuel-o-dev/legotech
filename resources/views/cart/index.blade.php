@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
    <div class="mx-auto mt-10 max-w-3xl">

        <h1 class="mb-6 text-3xl font-bold text-yellow-400">Seu Carrinho</h1>

        @if (count($cart) === 0)
            <p class="text-white">Nenhum item no carrinho.</p>
        @else
            <div class="rounded bg-[#0b1d3a] p-6 text-white shadow-md">

                @php $total = 0; @endphp

                @foreach ($cart as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp

                    <div class="flex items-center justify-between border-b border-gray-700 py-4">

                        <img src="{{ asset('storage/' . $item['image']) }}" class="w-20 rounded shadow">

                        <div>
                            <p class="font-bold">{{ $item['name'] }}</p>
                            <p>R$ {{ number_format($item['price'], 2, ',', '.') }}</p>
                            <p class="text-sm opacity-70">Qtd: {{ $item['quantity'] }}</p>
                        </div>

                        <div class="flex gap-2">

                            <form method="POST" action="{{ route('cart.decrease', $item['id']) }}">
                                @csrf
                                <button dusk="decrease-{{ $item['id'] }}"
                                    class="rounded bg-yellow-400 px-3 py-1 font-bold">-</button>

                            </form>

                            <form method="POST" action="{{ route('cart.add', $item['id']) }}">
                                @csrf
                                <button dusk="increase-{{ $item['id'] }}"
                                    class="rounded bg-yellow-400 px-3 py-1 font-bold">+</button>
                            </form>

                            <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                @csrf
                                @method('DELETE')

                                {{-- if to verify if is DUSK --}}
                                @if (app()->environment('dusk'))
                                <button dusk="remove-{{ $item['id'] }}"
                                    class="rounded bg-blue-600 px-3 py-1 font-bold">
                                    X
                                </button>
                                @else
                                {{-- alert to confirm removal --}}
                                <button
                                    onclick="return confirm('Tem certeza que deseja remover este item do carrinho?')"
                                    class="rounded bg-red-600 px-3 py-1 font-bold">
                                    X
                                </button>
                                @endif
                            </form>

                        </div>

                    </div>
                @endforeach

                <div class="mt-6 text-right text-xl font-bold text-yellow-400">
                    Total: R$ {{ number_format($total, 2, ',', '.') }}
                </div>

                <div class="mt-4 text-right">
                    <a href="{{ route('checkout.index') }}"
                        class="rounded bg-yellow-400 px-4 py-2 font-bold text-black hover:bg-yellow-300">
                        Finalizar compra
                    </a>
                </div>

            </div>

        @endif

    </div>
@endsection
