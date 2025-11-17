<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'LegoTech')</title>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <main>
        @yield('content')
        </main>

        <footer class="bg-yellow-600 text-white">
            <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between">
                <p class="text-sm">&copy; {{ date('Y') }} LegoTech. Todos os direitos reservados.</p>
                
            </div>
        </footer>

        @stack('scripts')

</body>

</html>