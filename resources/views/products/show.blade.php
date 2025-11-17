@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-5xl mx-auto mt-10 text-white">
    
    <div class="grid md:grid-cols-2 gap-10">

        {{-- IMAGEM --}}
        <div>
            <img src="{{ asset('storage/' . $product->image_path) }}" 
                 class="w-full rounded shadow-lg">
        </div>

        {{-- DETALHES --}}
        <div>
            <h1 class="text-4xl font-bold text-yellow-400">{{ $product->name }}</h1>

            <p class="mt-4 text-2xl font-bold text-green-400">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </p>

            <p class="mt-6 opacity-80">
                {{ $product->description }}
            </p>

            {{-- Especificações JSON --}}
            @if($product->specs)
                <div class="mt-6">
                    <h3 class="text-xl font-bold text-yellow-400">Especificações</h3>

                    <ul class="mt-3 space-y-1">
                        @foreach($product->specs as $spec)
                            <li class="text-white opacity-80">• {{ $spec }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Botão de adicionar ao carrinho --}}
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
                @csrf
                <button 
                    class="bg-yellow-400 text-black px-6 py-3 font-bold rounded text-lg hover:bg-yellow-300">
                    Adicionar ao Carrinho
                </button>
            </form>

        </div>
    </div>

    <div class="mt-10">
        <a href="{{ route('products.index') }}" 
           class="text-yellow-400 hover:underline font-bold">
            ← Voltar aos produtos
        </a>
    </div>

</div>
@endsection
