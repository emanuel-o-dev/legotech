<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- icon --}}
    <link rel="icon" href="{{ asset('/images/lego.png') }}">
    {{-- Vite --}}
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
                <a href="{{ route('cart.index') }}" class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h8l4-8H5.4M7 13L5.4 5M7 13l-1.293 6.293A1 1 0 007 21h10a1 1 0 00.975-.783L20 13H7z" />
                    </svg>

                    @if (cartCount() > 0)
                        <span class="badge badge-warning absolute -right-2 -top-2">
                            {{ cartCount() }}
                        </span>
                    @endif
                </a>
                @if (auth()->check())
                    {{-- orders --}}
                    <a href="{{ route('user.orders') }}" class="font-semibold hover:opacity-70">Meus Pedidos</a>
                @endif


                <!-- Login -->
                @if (auth()->check())
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="font-bold text-black">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-black">Login</a>
                @endif
                {{-- Link para Admin --}}
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-black font-bold">
                            Painel Admin
                        </a>
                    @endif

                    
                    <form method="POST" action="{{ route('toggle.role', auth()->user()) }}" class="inline">
                        @csrf
                        <button type="submit" class="rounded  px-2 py-1 text-sm text-black font-bold">
                            Mudar ROLE (Atual: {{ auth()->user()->role }})
                        </button>
                    </form>
                @endauth
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

    <!-- TOAST MESSAGES -->
    @if (session('success'))
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast toast-top toast-end z-50">
            <div class="alert alert-error">
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

</body>

</html>
