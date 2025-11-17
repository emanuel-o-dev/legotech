<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'LegoTech')</title>
</head>

<body class="min-h-screen flex flex-col bg-[#071529] text-white">

    <!-- HEADER -->
    <header class="bg-yellow-400 text-black py-4 shadow-md">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4">

            <!-- Logo -->
            <a href="/" class="text-xl font-extrabold tracking-wide">
                LEGO-TECH
            </a>

            <div class="flex items-center gap-6">

                <!-- Link Produtos -->
                <a href="{{ route('products.index') }}" class="font-semibold hover:opacity-70">Produtos</a>

                <!-- Carrinho -->
                <a href="{{ route('cart.index') }}" class="relative hover:opacity-70 text-xl">
                    🛒
                </a>

                <!-- Login / Dashboard -->
                @auth
                    <a href="/dashboard" class="font-semibold hover:opacity-70">Painel</a>
                @else
                    <a href="/login" class="font-semibold hover:opacity-70">Login</a>
                @endauth

            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-yellow-400 text-black py-3 mt-10">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm font-semibold">
            © {{ date('Y') }} LegoTech • Todos os direitos reservados • Desenvolvido por Emanuel
        </div>
    </footer>

</body>
</html>
