@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')
<div class="max-w-3xl mx-auto mt-10">

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Criar Produto</h1>

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

        <form action="{{ route('admin.products.store') }}" 
              method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Nome</label>
                <input type="text" name="name"
                       class="w-full px-3 py-2 rounded text-black" />
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Descrição</label>
                <textarea name="description"
                          class="w-full px-3 py-2 rounded text-black h-24"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Preço</label>
                <input type="number" step="0.01" name="price"
                       class="w-full px-3 py-2 rounded text-black" />
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Categoria</label>
                <select name="category_id"
                        class="w-full px-3 py-2 rounded text-black">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Imagem</label>
                <input type="file" name="image"
                       class="w-full text-white" />
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Especificações (JSON)</label>
                <textarea name="specs"
                          class="w-full px-3 py-2 rounded text-black h-24"
                          placeholder='{"pecas":120,"tamanho":"30cm"}'></textarea>
            </div>

            <button class="bg-yellow-400 text-black px-4 py-2 font-bold rounded hover:bg-yellow-300">
                Salvar
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="ml-4 text-yellow-400 font-bold hover:underline">
                Voltar
            </a>

        </form>

    </div>

</div>
@endsection
