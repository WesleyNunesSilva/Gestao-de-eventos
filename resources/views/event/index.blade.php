@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="text-left my-4">Eventos</h2>   
            @if(auth()->user()->type !== 'registered')
                <a  class="btn btn-edit " href="{{route('events.create')}}">
                    Novo evento
                </a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="text-center">
                    <tr>
                        <th class="text-light bg-dark-blue">Título</th>
                        <th class="text-light bg-dark-blue">Descrição</th>
                        <th class="text-light bg-dark-blue">Data</th>
                        <th class="text-light bg-dark-blue">Local</th>
                        <th class="text-light bg-dark-blue">Organizador</th>
                        <th class="text-light bg-dark-blue">Preço</th>
                        <th class="text-light bg-dark-blue">Ação</th>                   
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($events as $event) 
                        <tr>
                            <td class="py-3 px-6">{{ $event->title }}</td>
                            <td class="py-3 px-6">{{ $event->description }}</td>
                            <td class="py-3 px-6">{{ $event->date }}</td>
                            <td class="py-3 px-6">{{ $event->location }}</td>
                            <td class="py-3 px-6">{{ $event->organizer->name}}</td>
                            <td class="py-3 px-6">{{ $event->price }}</td>
                            @if(auth()->user()->type === 'admin' || auth()->id() === $event->organizer_id)
                                <td class="py-3 px-6">
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- Botão para abrir o modal de edição -->
                                        <a href="{{route('events.edit', $event->id)}}" class="btn btn-edit">
                                            Editar
                                        </a>
                                
                                        <!-- Formulário para exclusão do usuário -->
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar este evento?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @elseif (auth()->user()->type === 'registered' )
                                <td class="py-3 px-6">
                                    <div class="d-flex justify-content-center gap-3">
                                        <form action="{{ route('registrations.store', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-edit">
                                                Inscrever-se
                                            </button>                       
                                        </form>

                                    </div>
                                </td>                       
                            @else
                                <td></td>                              
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
@endsection