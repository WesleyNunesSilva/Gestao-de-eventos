@extends('layouts.app')

@section('content')
    <div class="container pb-4">
        <h2 class="text-left my-4">Relatório Financeiro</h2>
        <div class="card shadow-sm">
            <div class="card-header bg-dark-blue text-light">
                <h3>Pagamentos</h3>
            </div>
            <div class="card-body">
                <p>Total Recebido: R$ {{ number_format($totalReceived, 2, ',', '.') }}</p>
                <p>Total Pendente: R$ {{ number_format($totalPending, 2, ',', '.') }}</p>
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Valor</th>
                            <th>Método de Pagamento</th>
                            <th>Status</th>
                            <th>Data de Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->formatted_value }}</td>
                            <td class="py-3 px-6"> 
                                @switch($payment->payment_method)
                                    @case('credit_card')
                                            Cartão de Credito
                                        @break
                                    
                                    @case('boleto')
                                        Boleto
                                    @break
                                
                                    @default
                                        
                                @endswitch
                            </td>
                            <td>{{ $payment->status }}</td>
                            <td>{{ $payment->formatted_payment_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>   
    </div>
@endsection
