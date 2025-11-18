@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto mt-16 bg-[#0b1d3a] p-8 rounded-lg shadow-lg text-white">

    <h1 class="text-3xl font-bold text-yellow-400 mb-6">Entrar</h1>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-600 text-white rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.perform') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-yellow-400 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full px-3 py-2 rounded text-white" required />
        </div>

        <div class="mb-6">
            <label class="block text-yellow-400 mb-1">Senha</label>
            <input type="password" name="password"
                   class="w-full px-3 py-2 rounded text-white" required />
        </div>

        <button class="bg-yellow-400 text-black font-bold w-full py-3 rounded hover:bg-yellow-300">
            Entrar
        </button>
    </form>

</div>
@endsection
