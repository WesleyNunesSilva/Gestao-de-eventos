@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->user()->type == 'registered')
            <h2 class="text-left my-4">Meus Pagamentos</h2>
        @else

            <h2 class="text-left my-4">Pagamentos</h2>
        @endif

        @if($payments->isEmpty())
            <p class="text-center my-4">Não há pagamentos registrados.</p>
        @else
            <div class="table-responsive">
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
                            <td class="py-3 px-6">{{ $payment->formatted_value }}</td>
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

                            <td class="py-3 px-6">
                                @if ($payment->registration->hasPayment())
                                    @if ($payment->registration->payment->status == 'pending')
                                    <span class="text-warning">
                                        <i class="fas fa-hourglass-half"></i> 
                                        Pendente
                                    </span>
                                    @elseif ($payment->registration->payment->status == 'completed')
                                        <span class=" text-success">
                                            <i class="fas fa-check"></i> 
                                            Confirmado
                                        </span>
                                    @elseif ($payment->registration->payment->status == 'canceled')
                                        <span class=" text-danger badge-danger">
                                            <i class="fas fa-times"></i>
                                            Cancelado
                                        </span>
                                    @endif
                                @else
                                    Sem pagamento
                                @endif
                            </td>
                            <td class="py-3 px-6">{{ $payment->formatted_payment_date }}</td>
                            <td class="py-3 px-6">
                                <div class="d-flex justify-content-center gap-3">
                                    @if (!$payment->registration->hasPayment())
                                        <form action="{{ route('payments.create', $payment->registration_id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-edit">
                                                Efetuar pagamento
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

            {{-- Paginação --}}
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
        
                        {{-- Primeira página --}}
                        <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $payments->url(1) }}" aria-label="Primeira página">
                                <span aria-hidden="true">&laquo;&laquo;</span>
                            </a>
                        </li>
        
                        {{-- Anterior Page Link --}}
                        <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $payments->previousPageUrl() }}" rel="prev" aria-label="Anterior">
                                <span aria-hidden="true">&lsaquo;</span>
                            </a>
                        </li>
        
                        {{-- Pagination Elements --}}
                        @php
                            $pageRange = 3; // Quantidade de páginas antes e depois da atual para exibir
                            $currentPage = $payments->currentPage();
                            $lastPage = $payments->lastPage();
                            $startPage = max($currentPage - $pageRange, 1);
                            $endPage = min($currentPage + $pageRange, $lastPage);
                        @endphp
        
                        @for ($page = $startPage; $page <= $endPage; $page++)
                            <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ $payments->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor
        
                        {{-- Próximo Page Link --}}
                        <li class="page-item {{ !$payments->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $payments->nextPageUrl() }}" rel="next" aria-label="Próxima">
                                <span aria-hidden="true">&rsaquo;</span>
                            </a>
                        </li>
        
                        {{-- Última página --}}
                        <li class="page-item {{ !$payments->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $payments->url($lastPage) }}" aria-label="Última página">
                                <span aria-hidden="true">&raquo;&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> 
        @endif
    </div>
@endsection
