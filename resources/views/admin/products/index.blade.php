@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <a href="{{ route('admin.dashboard') }}" class="text-yellow-400 font-bold hover:underline mb-4 inline-block">Voltar</a>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-yellow-400">Produtos</h1>

        <a href="{{ route('admin.products.create') }}"
           class="bg-yellow-400 text-black px-4 py-2 font-bold rounded hover:bg-yellow-300">
            + Novo Produto
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-600 text-white rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-[#0b1d3a] p-6 rounded shadow-md">
        <table class="w-full text-left">
            <thead>
                <tr class="text-yellow-400 border-b border-gray-600">
                    <th class="py-2">ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>

            <tbody class="text-white">
                @foreach($products as $product)
                    <tr class="border-b border-gray-700">
                        <td class="py-3">{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                     class="w-16 h-16 object-cover rounded">
                            @endif
                        </td>

                        <td class="text-right">

                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="text-blue-400 font-bold hover:underline mr-4">
                                Editar
                            </a>

                            <form action="{{ route('admin.products.destroy', $product) }}"
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Tem certeza que deseja remover?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-400 font-bold hover:underline">
                                    Remover
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
