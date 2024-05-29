@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center my-4">Eventos</h2>
        <table class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Local</th>
                    <th>Organizador</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($events as $event)
                    <tr>
                        <td class="py-3 px-6">{{ $event->id }}</td>
                        <td class="py-3 px-6">{{ $event->title }}</td>
                        <td class="py-3 px-6">{{ $event->description }}</td>
                        <td class="py-3 px-6">{{ $event->date }}</td>
                        <td class="py-3 px-6">{{ $event->location }}</td>
                        <td class="py-3 px-6">{{ $event->organizer_id }}</td>
                        <td class="py-3 px-6">{{ $event->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $events->links() }}
        </div>
    </div>
@endsection