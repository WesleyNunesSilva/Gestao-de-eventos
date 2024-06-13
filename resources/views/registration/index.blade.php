@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->user()->type == 'registered')
            <h2 class="text-left my-4">Minhas Inscrições</h2>
        @else
            <h2 class="text-left my-4">Inscritos</h2>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="text-center">
                    <tr>
                        <th class="text-light bg-dark-blue">Usuário cadastrado</th>
                        <th class="text-light bg-dark-blue">Evento</th>
                        <th class="text-light bg-dark-blue">Data de cadastro</th>
                        <th class="text-light bg-dark-blue">Data do evento</th>
                        <th class="text-light bg-dark-blue">Status do cadastro</th>
                        <th class="text-light bg-dark-blue">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($registrations as $registration) 
                        <tr>
                            <td class="py-3 px-6">{{ $registration->user->name }}</td>
                            <td class="py-3 px-6">{{ $registration->event->title }}</td>
                            <td class="py-3 px-6">{{ $registration->formatted_registration_date }}</td>
                            <td class="py-3 px-6">{{ $registration->formatted_event_date }}</td>
                            <td class="py-3 px-6">
                                @switch($registration->status)
                                    @case('pending')
                                        <span class="text-warning">
                                            <i class="fas fa-hourglass-half"></i> 
                                            Pendente
                                        </span>
                                        @break
                                    @case('confirmed')
                                        <span class=" text-success">
                                            <i class="fas fa-check"></i> 
                                            Confirmado
                                        </span>
                                        @break
                                    @case('canceled')
                                        <span class=" text-danger badge-danger">
                                            <i class="fas fa-times"></i>
                                            Cancelado
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="py-3 px-6">
                                <div class="d-flex justify-content-center gap-3">
                                    @if(auth()->user()->type !== 'registered' || auth()->id() === $registration->organizer_id)
                                        <form action="{{ route('registrations.destroy', $registration->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger" onclick="return confirm('Tem certeza que deseja cancelar essa inscrição?')">
                                                Excluir
                                            </button>
                                        </form>

                                        @if($registration->status == 'pending')
                                            <form action="{{ route('registrations.update', $registration) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="status" value="confirmed" class="btn text-success" onclick="return confirm('Tem certeza que deseja confirmar essa inscrição?')">
                                                    <i class="fas fa-check"></i> Confirmar
                                                </button>
                                                <button type="submit" name="status" value="canceled" class="btn text-danger" onclick="return confirm('Tem certeza que deseja cancelar essa inscrição?')">
                                                    <i class="fas fa-times"></i> Cancelar
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    @if($registration->status == 'pending' && !$registration->payment)
                                        <form action="{{ route('payments.create', $registration->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-edit">
                                                Realizar Pagamento
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $registrations->links() }}
        </div>
    </div>
@endsection
