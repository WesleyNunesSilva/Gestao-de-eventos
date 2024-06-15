@extends('layouts.app')

@section('content')
    <div class="container">

        <div class=" mb-3">
            <div>
                <h2 class="text-left my-4">Eventos</h2>
            </div>
            <div class="d-flex align-items-center gap-3 flex-wrap justify-content-between">
                <form class="form-inline d-flex flex-row gap-3 " method="GET" action="{{ route('events.index') }}">
                    @csrf
                    <div class="form-group ">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Pesquisar evento" value="{{ request()->input('title') }}">
                    </div>
                    <button type="submit" class="btn btn-edit ">Filtrar</button>
                </form>
                @if(auth()->user()->type !== 'registered')
                    <a class="btn btn-edit " href="{{ route('events.create') }}">
                        Novo evento
                    </a>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            @if($events->isEmpty())
                <p class="text-center my-4">Não há eventos registrados.</p>
            @else

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
            @endif
        </div>
        {{-- Paginação --}}
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
    
                    {{-- Primeira página --}}
                    <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $events->url(1) }}" aria-label="Primeira página">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                        </a>
                    </li>
    
                    {{-- Anterior Page Link --}}
                    <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $events->previousPageUrl() }}" rel="prev" aria-label="Anterior">
                            <span aria-hidden="true">&lsaquo;</span>
                        </a>
                    </li>
    
                    {{-- Pagination Elements --}}
                    @php
                        $pageRange = 3; // Quantidade de páginas antes e depois da atual para exibir
                        $currentPage = $events->currentPage();
                        $lastPage = $events->lastPage();
                        $startPage = max($currentPage - $pageRange, 1);
                        $endPage = min($currentPage + $pageRange, $lastPage);
                    @endphp
    
                    @for ($page = $startPage; $page <= $endPage; $page++)
                        <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="{{ $events->url($page) }}">{{ $page }}</a>
                        </li>
                    @endfor
    
                    {{-- Próximo Page Link --}}
                    <li class="page-item {{ !$events->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $events->nextPageUrl() }}" rel="next" aria-label="Próxima">
                            <span aria-hidden="true">&rsaquo;</span>
                        </a>
                    </li>
    
                    {{-- Última página --}}
                    <li class="page-item {{ !$events->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $events->url($lastPage) }}" aria-label="Última página">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                        </a>
                    </li>
    
                </ul>
            </nav>
        </div>
    </div>
@endsection
