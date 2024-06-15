@extends('layouts.app')

@section('content')

    <div class="py-4 px-6">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Usuários</h2>
            @if(auth()->user()->type === 'admin')
                <!-- Botão para criar novo usuário -->
                <a href="{{ route('users.create') }}" class="btn btn-edit">Novo Usuário</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-striped ">
                <thead class="text-center">
                    <tr >
                        <th scope="col" class="text-light bg-dark-blue">Nome</th>
                        <th scope="col" class="text-light bg-dark-blue">Email</th>
                        <th scope="col" class="text-light bg-dark-blue">Tipo</th>
                        @if(auth()->user()->type === 'admin')
                            <th scope="col" class="text-light bg-dark-blue">Ações</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $user)
                        <tr>
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">
                                @switch($user->type )

                                    @case('admin')
                                        Administrador
                                        @break
                                    @case('organizer')
                                        Organizador
                                        @break
                                    @case('registered')
                                        Usuário
                                        @break
                                @endswitch

                            </td>
                            @if(auth()->user()->type === 'admin')
                                <td class="py-3 px-6">
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- Botão para abrir o modal de edição -->
                                        <button type="button" class="btn btn-edit" data-toggle="modal" data-target="#editUserModal-{{ $user->id }}">
                                            Editar
                                        </button>
                            
                                        <!-- Formulário para exclusão do usuário -->
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar este usuário?')">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>

                        <!-- Modal para editar usuário -->
                        <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-between">
                                        <h5 class="modal-title" id="editUserModalLabel-{{ $user->id }}">Editar Usuário</h5>
                                        <a type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                                            <span>x</span>
                                        </a>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label for="name" class="form-label">Nome</label>
                                                <input type="text" class="form-control " id="name" name="name" value="{{ $user->name }}" required>
                                            </div>

                                            <div class="mb-4">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                            </div>

                                            <div class="mb-4 form-group">
                                                <label for="type" class="form-label">Tipo</label>
                                                <select name="type" id="type" class="form-select py-2 px-3">
                                                    <option value="registered" {{ $user->type === 'registered' ? 'selected' : '' }}>Usuário</option>
                                                    <option value="organizer" {{ $user->type === 'organizer' ? 'selected' : '' }}>Organizador</option>
                                                    <option value="admin" {{ $user->type === 'admin' ? 'selected' : '' }}>Administrador</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-edit">Salvar alterações</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        
         {{-- Paginação --}}
         <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
    
                    {{-- Primeira página --}}
                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->url(1) }}" aria-label="Primeira página">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                        </a>
                    </li>
    
                    {{-- Anterior Page Link --}}
                    <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev" aria-label="Anterior">
                            <span aria-hidden="true">&lsaquo;</span>
                        </a>
                    </li>
    
                    {{-- Pagination Elements --}}
                    @php
                        $pageRange = 3; // Quantidade de páginas antes e depois da atual para exibir
                        $currentPage = $users->currentPage();
                        $lastPage = $users->lastPage();
                        $startPage = max($currentPage - $pageRange, 1);
                        $endPage = min($currentPage + $pageRange, $lastPage);
                    @endphp
    
                    @for ($page = $startPage; $page <= $endPage; $page++)
                        <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                        </li>
                    @endfor
    
                    {{-- Próximo Page Link --}}
                    <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next" aria-label="Próxima">
                            <span aria-hidden="true">&rsaquo;</span>
                        </a>
                    </li>
    
                    {{-- Última página --}}
                    <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->url($lastPage) }}" aria-label="Última página">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                        </a>
                    </li>
    
                </ul>
            </nav>
        </div>
    </div>
@endsection