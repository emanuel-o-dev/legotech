@extends('layouts.app')

@section('title', 'Pedido concluído!')

@section('content')
<div class="max-w-xl mx-auto mt-16 text-center">

    <h1 class="text-3xl font-bold text-green-400">Compra realizada!</h1>

    <p class="text-white mt-4">Número do pedido:</p>
    <p class="text-yellow-400 text-2xl font-bold">{{ $order->id }}</p>

    <a href="/" class="mt-6 inline-block text-yellow-400 font-bold hover:underline">
        Voltar à loja
    </a>

</div>
@endsection
