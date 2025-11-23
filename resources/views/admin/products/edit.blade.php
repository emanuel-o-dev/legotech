@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <a href="{{ route('admin.products.index') }}" class="text-yellow-400 font-bold hover:underline mb-4 inline-block">Voltar</a>

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Editar Produto</h1>

    <div class="bg-[#0b1d3a] p-6 rounded shadow-md">

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-600 text-white rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" 
              method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Nome</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="w-full border border-yellow-400 px-3 py-2 rounded text-white" />
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Descrição</label>
                <textarea name="description"
                          class="w-full border border-yellow-400 px-3 py-2 rounded text-white h-24">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Preço</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                       class="w-full border border-yellow-400 px-3 py-2 rounded text-white" />
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Categoria</label>
                <select name="category_id"
                        class="w-full px-3 py-2 rounded text-white">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string)old('category_id', $product->category_id) === (string)$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Imagem atual</label>
                @if($product->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-48 h-auto rounded">
                    </div>
                @else
                    <div class="mb-2 text-yellow-400">Nenhuma imagem enviada</div>
                @endif

                <label class="block text-yellow-400 font-bold mb-1">Trocar imagem</label>
                <input type="file" name="image"
                       class="w-full border border-yellow-400 text-white" />
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Especificações (JSON)</label>
                <textarea name="specs"
                          class="w-full border border-yellow-400 px-3 py-2 rounded text-white h-24"
                          placeholder='{"pecas":120,"tamanho":"30cm"}'>{{ old('specs', $product->specs ? json_encode($product->specs, JSON_UNESCAPED_UNICODE) : '') }}</textarea>
            </div>

            <button class="bg-yellow-400 text-white px-4 py-2 font-bold rounded hover:bg-yellow-300">
                Atualizar
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="ml-4 text-yellow-400 font-bold hover:underline">
                Voltar
            </a>

        </form>

    </div>

</div>
@endsection
