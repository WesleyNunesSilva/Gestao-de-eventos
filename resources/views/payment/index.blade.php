@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-left my-4">Pagamentos</h2>
        <table class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th class="text-light bg-dark-blue">Valor</th>
                    <th class="text-light bg-dark-blue">Método de pagamento</th>
                    <th class="text-light bg-dark-blue">Status</th>
                    <th class="text-light bg-dark-blue">Data de pagamento</th>
                    <th class="text-light bg-dark-blue">Ação</th>                   
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($payments as $payment) 
                    <tr>
                        <td class="py-3 px-6">{{ $payment->value }}</td>
                        <td class="py-3 px-6">{{ $payment->payment_method }}</td>
                        <td class="py-3 px-6">{{ $payment->status }}</td>
                        <td class="py-3 px-6">{{ $payment->payment_date }}</td>
                        
                        <td class="py-3 px-6">
                            <div class="d-flex justify-content-center gap-3">
                                <!-- Botão para efetuar pagamento -->
                                <form action="{{ route('payments.create', $payment->registration_id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-edit">
                                        Efetuar pagamento
                                    </button>                           

                                </form>
                                <!-- Formulário para atualizar o status do pagamento -->
                                <form action="{{ route('payments.updateStatus', $payment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pendente</option>
                                        <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completo</option>
                                        <option value="canceled" {{ $payment->status == 'canceled' ? 'selected' : '' }}>Cancelado</option>
                                    </select>
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
