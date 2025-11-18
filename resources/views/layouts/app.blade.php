<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'LegoTech')</title>
</head>

<body class="flex min-h-screen flex-col bg-[#071529] text-white">

    <!-- HEADER -->
    <header class="bg-yellow-400 py-4 text-black shadow-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4">

            <!-- Logo -->
            <a href="/" class="text-xl font-extrabold tracking-wide">
                LEGO-TECH
            </a>

            <div class="flex items-center gap-6">

                <!-- Link Produtos -->
                <a href="{{ route('products.index') }}" class="font-semibold hover:opacity-70">Produtos</a>

                <!-- Carrinho -->
                <a href="{{ route('cart.index') }}" class="relative text-xl hover:opacity-70">
                    🛒
                </a>

                <!-- Login / Dashboard -->
                @if (auth()->check())
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="font-bold text-black">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-black">Login</a>
                @endif

            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="mt-10 bg-yellow-400 py-3 text-black">
        <div class="mx-auto max-w-7xl px-4 text-center text-sm font-semibold">
            © {{ date('Y') }} LegoTech • Todos os direitos reservados • Desenvolvido por Emanuel
        </div>
    </footer>

</body>

</html>
