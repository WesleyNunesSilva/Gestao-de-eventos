<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
      
    </head>
    <body class="antialiased ">
        <header class="bg-gray-100 shadow-lg">
            <nav class="flex items-center justify-between px-6 py-4">
                <div class="font-bold">
                    <h5>Logo</h5>
                </div>
                <div>
                    <button class="px-3 py-2 border rounded-md bg-red-600 text-white">Sair</button>
                </div>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
    </body>
</html>
