@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="max-w-7xl mx-auto mt-10">

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Produtos LEGO</h1>

    {{-- Lista de produtos --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

        @foreach($products as $product)
            <div class="bg-[#0b1d3a] rounded-lg p-4 shadow-lg">

                <a href="{{ route('products.show', $product) }}">
                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                         class="w-full h-52 object-cover rounded shadow-md mb-3">
                </a>

                <h2 class="text-lg font-bold text-yellow-400">
                    {{ $product->name }}
                </h2>

                <p class="text-white opacity-80 mt-1">
                    R$ {{ number_format($product->price, 2, ',', '.') }}
                </p>

                <a href="{{ route('products.show', $product) }}"
                    class="mt-4 block bg-yellow-400 text-black text-center font-bold px-3 py-2 rounded hover:bg-yellow-300">
                    Ver Detalhes
                </a>

            </div>
        @endforeach

    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>

</div>
@endsection
