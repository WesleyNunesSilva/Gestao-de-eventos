@extends('layouts.app')

@section('content')

    <div class="container w-full ">
        <div class="px-14 w-screen">
            <div class="flex gap-3  ">
                <div class="card-users flex flex-col gap-2 w-full borded rounded text-white bg-sky-900  p-5 mt-5">
                    <h3 class="text-xl font-bold">Total de Usuários</h3>
                    <span class="  my-2">Usuário cadastrados: X</span>
                    <hr>
                    <div class="flex items-center ">
                        <a class="border border-whi rounded px-3 py-1.5 " href='{{route('user.index')}}'>Ver usuários</a>
                    </div>
                </div>
                <div class="card-users flex flex-col gap-2 w-full borded rounded text-white bg-blue-900 p-5 mt-5">
                    <h3 class="text-xl font-bold">Total de Eventos</h3>
                    <span class="  my-2">Usuário cadastrados: X</span>
                    <hr>
                    <div class="flex items-center ">
                        <a class="border border-white rounded px-3 py-1.5" href='{{route('event.index')}}'>Ver Eventos</a>
                    </div>
                </div>
            </div>
    
            <div class="flex gap-3 w-50">
                <div class="card-users flex flex-col gap-2 w-full borded rounded text-white bg-cyan-800 p-5 mt-5">
                    <h3 class="text-xl font-bold">Total de inscrições</h3>
                    <span class="  my-2">Usuário cadastrados: X</span>
                    <hr>
                    <div class="flex items-center ">
                        <a class="border border-white rounded px-3 py-1.5" href='{{route('registration.index')}}'>Ver inscrições</a>
                    </div>
                </div>
                <div class="card-users flex flex-col gap-2 w-full borded rounded text-white bg-emerald-700 p-5 mt-5">
                    <h3 class="text-xl font-bold">Total de Pagamento</h3>
                    <span class="  my-2">Usuário cadastrados: X</span>
                    <hr>
                    <div class="flex items-center ">
                        <a class="border border-white rounded px-3 py-1.5" href='{{route('payment.index')}}'>Ver pagamentos</a>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
@endsection