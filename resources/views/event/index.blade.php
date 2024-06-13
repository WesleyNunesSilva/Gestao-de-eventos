@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="text-left my-4">Eventos</h2>   
            @if(auth()->user()->type !== 'registered')
                <a class="btn btn-edit" href="{{ route('events.create') }}">
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
                            <td class="py-3 px-6">{{ Str::limit($event->description, 50, '...') }}</td>
                            <td class="py-3 px-6">{{ $event->formatted_date }}</td>
                            <td class="py-3 px-6">{{ $event->location }}</td>
                            <td class="py-3 px-6">{{ $event->organizer->name }}</td>
                            <td class="py-3 px-6">{{ $event->formatted_price }}</td>
                            <td class="py-3 px-6">
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-edit">
                                        Ver mais
                                    </a>
                                </div>
                            </td>                           
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
