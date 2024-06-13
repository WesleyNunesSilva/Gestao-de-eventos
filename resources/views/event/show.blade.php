@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-left my-4">Detalhes do Evento</h2>
        <div class="card shadow-sm">
            <div class="card-header bg-dark-blue text-light">
                <h3>{{ $event->title }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2 font-weight-bold">Descrição</div>
                    <div class="col-md-10">{{ $event->description }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 font-weight-bold">Data</div>
                    <div class="col-md-10">{{ $event->formatted_date }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 font-weight-bold">Local</div>
                    <div class="col-md-10">{{ $event->location }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 font-weight-bold">Preço</div>
                    <div class="col-md-10">{{ $event->formatted_price }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2 font-weight-bold">Organizador</div>
                    <div class="col-md-10">{{ $event->organizer->name }}</div>
                </div>

                <div class="d-flex justify-content-start gap-3">
                    @if(auth()->user()->type === 'admin' || auth()->id() === $event->organizer_id)
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-edit">
                            Editar
                        </a>

                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar este evento?')">
                                Excluir
                            </button>
                        </form>

                        <a href="{{ route('events.payments', $event->id) }}" class="btn btn-edit">
                            Ver pagamentos
                        </a>
                    @elseif(auth()->user()->type === 'registered')
                        <form action="{{ route('registrations.store', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-edit">
                                Inscrever-se
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

