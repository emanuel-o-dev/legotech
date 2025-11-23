@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <div class="mx-auto mt-10 max-w-3xl">
        <a href="{{ route('admin.products.index') }}"
            class="mb-4 inline-block font-bold text-yellow-400 hover:underline">Voltar</a>

        <h1 class="mb-6 text-3xl font-bold text-yellow-400">Editar Produto</h1>

        <div class="rounded bg-[#0b1d3a] p-6 shadow-md">

            @if ($errors->any())
                <div class="mb-4 rounded bg-red-600 p-3 text-white">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="mb-1 block font-bold text-yellow-400">Nome</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="w-full rounded border border-yellow-400 px-3 py-2 text-white" />
                </div>

                <div class="mb-4">
                    <label class="mb-1 block font-bold text-yellow-400">Descrição</label>
                    <textarea name="description" class="h-24 w-full rounded border border-yellow-400 px-3 py-2 text-white">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="mb-1 block font-bold text-yellow-400">Preço</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                        class="w-full rounded border border-yellow-400 px-3 py-2 text-white" />
                </div>

                <div class="mb-4">
                    <label class="mb-1 block font-bold text-yellow-400">Categoria</label>
                    <select name="category_id" class="w-full rounded px-3 py-2 text-white">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ (string) old('category_id', $product->category_id) === (string) $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="mb-1 block font-bold text-yellow-400">Imagem atual</label>
                    @if ($product->image_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                class="h-auto w-48 rounded">
                        </div>
                    @else
                        <div class="mb-2 text-yellow-400">Nenhuma imagem enviada</div>
                    @endif

                    <label class="mb-1 block font-bold text-yellow-400">Trocar imagem</label>
                    <input type="file" class="file-input file-input-ghost" name="image" />

                </div>

                <div class="mb-4">
                    <label class="mb-1 block font-bold text-yellow-400">Especificações (JSON)</label>
                    <textarea name="specs" class="h-24 w-full rounded border border-yellow-400 px-3 py-2 text-white"
                        placeholder='{"pecas":120,"tamanho":"30cm"}'>{{ old('specs', $product->specs ? json_encode($product->specs, JSON_UNESCAPED_UNICODE) : '') }}</textarea>
                </div>

                <button class="rounded bg-yellow-400 px-4 py-2 font-bold text-white hover:bg-yellow-300">
                    Atualizar
                </button>

                <a href="{{ route('admin.products.index') }}" class="ml-4 font-bold text-yellow-400 hover:underline">
                    Voltar
                </a>

            </form>

        </div>

    </div>
@endsection
