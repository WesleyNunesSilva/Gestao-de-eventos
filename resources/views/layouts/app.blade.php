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
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased  ">
        @if (Auth::check())
            
        <header class="bg-light shadow-lg">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    @if(Auth::check() && Auth::user()->isRegistered())
                        <!-- Botão 'LOGO' desabilitado para inscritos -->
                        <span class="navbar-brand font-weight-bold">Logo</span>
                        
                    @else
                        <!-- Botão 'LOGO' habilitado para outros tipos de usuários -->
                        <a class="navbar-brand font-weight-bold" href="{{ url('/home') }}">Logo</a>
                    @endif
                    <div class="ml-auto">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                       
                        <a href="{{route('logout')}}" class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        @endif
        
        <main class="container">

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
