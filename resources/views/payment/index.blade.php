@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center my-4">Pagamentos</h2>
        <table class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th class="text-light bg-dark-blue">ID</th>
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
                @foreach ($payments as $payment) 
                    <tr>
                        <td class="py-3 px-6">{{ $payment->id }}</td>
                        <td class="py-3 px-6">{{ $payment->title }}</td>
                        <td class="py-3 px-6">{{ $payment->description }}</td>
                        <td class="py-3 px-6">{{ $payment->date }}</td>
                        <td class="py-3 px-6">{{ $payment->location }}</td>
                        <td class="py-3 px-6">{{ $payment->organizer->name }}</td>
                        <td class="py-3 px-6">{{ $payment->price }}</td>
                        
                        <td class="py-3 px-6">
                            <div class="d-flex justify-content-center gap-3">
                                <!-- Botão para edição da lista de cadastrado -->
                                <a href="{{route('payments.edit', $payment->id)}}" class="btn btn-edit">
                                    Editar
                                </a>
                                <!-- Formulário para exclusão do usuário cadastrado-->
                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar este pagamento?')">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>         
                    </tr>
                @endforeach
            </tbody>
            <div class="d-flex justify-content-center">
                {{ $payments->links() }}
            </div>
        </table>
    </div>
@endsection