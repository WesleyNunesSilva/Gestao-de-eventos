@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-left my-4">Pagamentos do Evento: {{ $event->title }}</h2>

        <div class="table-responsive">
            @if($payments->isEmpty())
                <p class="text-center my-4">Não há pagamentos registrados para este evento.</p>
            @else
                <table class="table table-striped">
                    <thead class="text-center">
                        <tr>
                            <th class="text-light bg-dark-blue">Valor</th>
                            <th class="text-light bg-dark-blue">Método de pagamento</th>
                            <th class="text-light bg-dark-blue">Status</th>
                            <th class="text-light bg-dark-blue">Data de pagamento</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="py-3 px-6">{{ $payment->formatted_value }}</td>
                                <td class="py-3 px-6">{{ $payment->payment_method }}</td>
                                <td class="py-3 px-6">
                                    @if ($payment->status == 'pending')
                                        Pendente
                                    @elseif ($payment->status == 'completed')
                                        Completo
                                    @elseif ($payment->status == 'canceled')
                                        Cancelado
                                    @endif
                                </td>
                                <td class="py-3 px-6">{{ $payment->formatted_payment_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
