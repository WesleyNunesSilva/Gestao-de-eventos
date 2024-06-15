@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-left my-4">Pagamentos do Evento: {{ $event->title }}</h2>

        @if($payments->isEmpty())
            <p class="text-center my-4">Não há pagamentos registrados para este evento.</p>
        @else
            <div class="table-responsive">
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
