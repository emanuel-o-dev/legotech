@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <a href="{{ route('admin.categories.index') }}" class="text-yellow-400 font-bold hover:underline mb-4 inline-block">Voltar</a>

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Editar Categoria</h1>

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

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Nome</label>
                <input type="text" name="name"
                       value="{{ $category->name }}"
                       class="w-full px-3 py-2 rounded text-black">
            </div>

            <div class="mb-4">
                <label class="block text-yellow-400 font-bold mb-1">Slug</label>
                <input type="text" name="slug"
                       value="{{ $category->slug }}"
                       class="w-full px-3 py-2 rounded text-black">
            </div>

            <button class="bg-yellow-400 text-black px-4 py-2 font-bold rounded hover:bg-yellow-300">
                Atualizar
            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="ml-4 text-yellow-400 font-bold hover:underline">
                Voltar
            </a>

        </form>
    </div>
</div>
@endsection
