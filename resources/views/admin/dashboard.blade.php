@extends('layouts.app')

@section('content')
    <div class="p-10 text-white">
        <h1 class="text-3xl font-bold">Painel Administrativo</h1>
        <p class="mt-3 opacity-80">Gerencie produtos, categorias e pedidos.</p>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('admin.products.index') }}" class="bg-yellow-400 px-4 py-2 font-bold rounded text-black">Produtos</a>
            <a href="{{ route('admin.categories.index') }}" class="bg-yellow-400 px-4 py-2 font-bold rounded text-black">Categorias</a>
            <a href="{{ route('admin.orders.index') }}" class="bg-yellow-400 px-4 py-2 font-bold rounded text-black">Pedidos</a>
        </div>
    </div>
@endsection
