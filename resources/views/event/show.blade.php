@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-left my-4">Detalhes do Evento</h2>
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header bg-dark-blue text-light">
                <h3>{{ $event->title }}</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Descrição:</strong>
                    <p>{{ $event->description }}</p>
                </div>
                <div class="mb-3">
                    <strong>Data:</strong>
                    <p>{{ $event->formatted_date }}</p>
                </div>
                <div class="mb-3">
                    <strong>Local:</strong>
                    <p>{{ $event->location }}</p>
                </div>
                <div class="mb-3">
                    <strong>Preço:</strong>
                    <p>{{ $event->formatted_price }}</p>
                </div>
                <div class="mb-3">
                    <strong>Organizador:</strong>
                    <p>{{ $event->organizer->name }}</p>
                </div>

                <div class="d-flex flex-wrap justify-content-start gap-3">
                    @if(auth()->user()->type === 'admin' || auth()->id() === $event->organizer_id)
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-edit mb-2">
                            Editar
                        </a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar este evento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-2">
                                Excluir
                            </button>
                        </form>
                        <a href="{{ route('events.payments', $event->id) }}" class="btn btn-edit mb-2">
                            Ver pagamentos
                        </a>
                    @elseif(auth()->user()->type === 'registered')
                        <form action="{{ route('registrations.store', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-edit mb-2">
                                Inscrever-se
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

