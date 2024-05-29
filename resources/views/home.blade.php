@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-custom bg-dark-blue mb-3">
                    <div class="card-body">
                        <h3 class="card-title text-light">
                            <i class="fas fa-users icon-small"></i> 
                            Total de Usuários
                        </h3>
                        <span class="card-text text-light">Usuários cadastrados: X</span>
                        <hr>
                        <div>
                            <a class="btn btn-custom" href="{{ route('users.index') }}">Ver usuários</a>
                        </div>
                    </div>
                </div>
                <div class="card card-custom bg-dark-blue mb-3 mt-3">
                    <div class="card-body">
                        <h3 class="card-title text-light">
                            <i class="fas fa-calendar-alt icon-small"></i> 
                            Total de Eventos
                        </h3>
                        <span class="card-text text-light">Eventos cadastrados: X</span>
                        <hr class="">
                        <div>
                            <a class="btn btn-custom" href="{{ route('events.index') }}">Ver Eventos</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-custom bg-dark-blue mb-3">
                    <div class="card-body">
                        <h3 class="card-title text-light">
                            <i class="fas fa-clipboard-list icon-small"></i> 
                            Total de Inscrições
                        </h3>
                        <span class="card-text text-light">Inscrições cadastradas: X</span>
                        <hr>
                        <div>
                            <a class="btn btn-custom" href="{{ route('registrations.index') }}">Ver Inscrições</a>
                        </div>
                    </div>
                </div>
                <div class="card card-custom bg-dark-blue mb-3 mt-3">
                    <div class="card-body">
                        <h3 class="card-title text-light">
                            <i class="fas fa-dollar-sign icon-small"></i> 
                            Total de Pagamentos
                        </h3>
                        <span class="card-text text-light">Pagamentos cadastrados: X</span>
                        <hr>
                        <div>
                            <a class="btn btn-custom" href="{{ route('payments.index') }}">Ver Pagamentos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection