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
            <header class="bg-light shadow-lg pt-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container">
                        <!-- Logo section -->
                        <div class="navbar-brand">
                            @if (Auth::user()->isRegistered())
                                <!-- Botão 'LOGO' desabilitado para inscritos -->
                                <span class="font-weight-bold">Início</span>
                            @else
                                <!-- Botão 'LOGO' habilitado para outros tipos de usuários -->
                                <a class="text-reset font-weight-bold text-decoration-none" href="{{ url('/home') }}">Início</a>
                            @endif
                        </div>

                        <!-- Toggler for mobile view -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navigation links and logout button -->
                        <div class="collapse navbar-collapse  justify-content-between" id="navbarContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('payment.index') }}">Eventos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('registrations.index') }}">Histórico de Inscrições</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ Auth::user()->type == 'organizer' || Auth::user()->type == 'admin' ? route('payments.financial') : route('payments.index') }}">Pagamentos</a>
                                </li>
                            </ul>
                            
                            <a class="btn btn-danger btn-sm" href="{{ route('logout') }}" 
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sair
                            </a>
                            
                        </div>

                        <!-- Logout form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
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
