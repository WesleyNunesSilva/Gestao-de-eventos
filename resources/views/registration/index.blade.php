@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center my-4">Inscritos</h2>
        <table class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th class="text-light bg-dark-blue">ID</th>
                    <th class="text-light bg-dark-blue">Usuario cadastrado</th>
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
                        <td class="py-3 px-6">{{ $registration->id }}</td>
                        <td class="py-3 px-6">{{ $registration->user->name}}</td>
                        <td class="py-3 px-6">{{ $registration->event->title}}</td>
                        <td class="py-3 px-6">{{ $registration->registration_date }}</td>
                        <td class="py-3 px-6">{{ $registration->event->date}}</td>
                        <td class="py-3 px-6">{{ $registration->status }}</td>
                        <td class="py-3 px-6">
                            <div class="d-flex justify-content-center gap-3">
                                <!-- Formulário para exclusão do usuário cadastrado-->
                                <form action="{{ route('registrations.destroy', $registration->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar essa inscrição?')">
                                        Cancelar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $registrations->links() }}
        </div>
    </div>
@endsection