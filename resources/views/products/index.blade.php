@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <div class="mx-auto mt-10 max-w-6xl">

        <h1 class="mb-6 text-3xl font-bold text-yellow-400">Produtos</h1>

        {{-- FILTRO DE CATEGORIAS --}}
        <div class="mb-6 flex flex-wrap gap-2">

            {{-- Botão "Todos" --}}
            <a href="{{ route('products.index') }}" class="btn {{ !$selectedCategory ? 'btn-warning' : 'btn-outline' }}">
                Todos
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}"
                    class="btn {{ $selectedCategory == $category->id ? 'btn-warning' : 'btn-outline' }}">
                    {{ $category->name }}
                </a>
            @endforeach

        </div>

        {{-- LISTA DE PRODUTOS --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">

            @forelse($products as $product)
                <a href="{{ route('products.show', $product) }}"
                    class="rounded-lg bg-[#0b1d3a] p-4 shadow duration-200 hover:scale-[1.02]">

                    <img src="{{ asset('storage/' . $product->image_path) }}"
                        class="mb-3 h-40 w-full rounded-lg object-cover">

                    <h3 class="text-lg font-bold text-white">{{ $product->name }}</h3>
                    <p class="text-xl font-bold text-yellow-400">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </p>
                </a>
            @empty
                <p class="text-white opacity-90">Nenhum produto encontrado nessa categoria.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>

    </div>
@endsection
