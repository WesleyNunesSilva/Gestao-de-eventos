@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->user()->type == 'registered')
            <h2 class="text-left my-4">Minhas Inscrições</h2>
        @else
            <h2 class="text-left my-4">Inscritos</h2>
        @endif

        @if($registrations->isEmpty())
                <p class="text-center my-4">Não há pagamentos registrados.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="text-center">
                        <tr>
                            <th class="text-light bg-dark-blue">Usuário inscrito</th>
                            <th class="text-light bg-dark-blue">Evento</th>
                            <th class="text-light bg-dark-blue">Data da Inscrição</th>
                            <th class="text-light bg-dark-blue">Data do evento</th>
                            <th class="text-light bg-dark-blue">Status da Inscrição</th>
                            <th class="text-light bg-dark-blue">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($registrations as $registration) 
                            <tr>
                                <td class="py-3 px-6">{{ $registration->user->name }}</td>
                                <td class="py-3 px-6">{{ $registration->event->title }}</td>
                                <td class="py-3 px-6">{{ $registration->formatted_registration_date }}</td>
                                <td class="py-3 px-6">{{ $registration->formatted_event_date }}</td>
                                <td class="py-3 px-6">
                                    @switch($registration->status)
                                        @case('pending')
                                            <span class="text-warning">
                                                <i class="fas fa-hourglass-half"></i> 
                                                Pendente
                                            </span>
                                            @break
                                        @case('confirmed')
                                            <span class=" text-success">
                                                <i class="fas fa-check"></i> 
                                                Confirmado
                                            </span>
                                            @break
                                        @case('canceled')
                                            <span class=" text-danger badge-danger">
                                                <i class="fas fa-times"></i>
                                                Cancelado
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="py-3 px-6">
                                    <div class="d-flex justify-content-center gap-3">

                                        @if($registration->canPay($user))
                                            <form action="{{ route('payments.create', $registration->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-edit">
                                                    Realizar Pagamento
                                                </button>
                                            </form>
                                        @endif

                                        @if($registration->canConfirm($user))
                                            <form action="{{ route('registrations.update', $registration) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="status" value="confirmed" class="btn text-success" onclick="return confirm('Tem certeza que deseja confirmar essa inscrição?')">
                                                    <i class="fas fa-check"></i> Confirmar
                                                </button>
                                            </form>
                                        @elseif($registration->canCancel($user))
                                            <form action="{{ route('registrations.update', $registration) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="status" value="canceled" class="btn btn-danger " onclick="return confirm('Tem certeza que deseja cancelar essa inscrição?')">
                                                    <i class="fas fa-times"></i> Cancelar
                                                </button>
                                            </form>
                                        @endif
                                
                                        @if($registration->canDelete($user))
                                            <form action="{{ route('registrations.destroy', $registration->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn text-danger" onclick="return confirm('Tem certeza que deseja excluir essa inscrição?')">
                                                    Excluir
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
                        <li class="page-item {{ $registrations->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $registrations->url(1) }}" aria-label="Primeira página">
                                <span aria-hidden="true">&laquo;&laquo;</span>
                            </a>
                        </li>
        
                        {{-- Anterior Page Link --}}
                        <li class="page-item {{ $registrations->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $registrations->previousPageUrl() }}" rel="prev" aria-label="Anterior">
                                <span aria-hidden="true">&lsaquo;</span>
                            </a>
                        </li>
        
                        {{-- Pagination Elements --}}
                        @php
                            $pageRange = 3; // Quantidade de páginas antes e depois da atual para exibir
                            $currentPage = $registrations->currentPage();
                            $lastPage = $registrations->lastPage();
                            $startPage = max($currentPage - $pageRange, 1);
                            $endPage = min($currentPage + $pageRange, $lastPage);
                        @endphp
        
                        @for ($page = $startPage; $page <= $endPage; $page++)
                            <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ $registrations->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor
        
                        {{-- Próximo Page Link --}}
                        <li class="page-item {{ !$registrations->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $registrations->nextPageUrl() }}" rel="next" aria-label="Próxima">
                                <span aria-hidden="true">&rsaquo;</span>
                            </a>
                        </li>
        
                        {{-- Última página --}}
                        <li class="page-item {{ !$registrations->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $registrations->url($lastPage) }}" aria-label="Última página">
                                <span aria-hidden="true">&raquo;&raquo;</span>
                            </a>
                        </li>
        
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
