@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-yellow-400">Categorias</h1>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-yellow-400 text-black px-4 py-2 font-bold rounded hover:bg-yellow-300">
            + Nova Categoria
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
                    <th>Slug</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>

            <tbody class="text-white">
                @foreach($categories as $category)
                    <tr class="border-b border-gray-700">
                        <td class="py-3">{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="text-right">

                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="text-blue-400 font-bold hover:underline mr-4">
                                Editar
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Tem certeza que deseja remover?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="text-red-400 font-bold hover:underline">
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
