@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <h2 class="">Criar Usuário</h2>

            <form action="{{ route('users.store') }}" method="POST" class="">
                @csrf
                <div class="">
                    <div class="">
                        <label for="name" class="">Nome</label>
                        <input type="text" class="" id="name" name="name"  required>
                    </div>
                    <div class="">
                        <label for="email" class="">E-mail</label>
                        <input type="email" class="" id="email" name="email"  required>
                    </div>
                   
                </div>
         
                <div class="">
                    <label for="password" class="">Senha</label>
                    <input type="password" class="" id="password" name="password" autocomplete="off" required>
                </div>

                <div class="">
                    <label for="type" class="">Tipo:</label>
                    <select name="type" id="type" class="">
                        <option value="Usuário" >Usuário</option>
                        <option value="Organizador" >Organizador</option>
                        <option value="Administrador" >Administrador</option>
                    </select>
                </div>
                <button type="submit" class="">Cadastrar</button>
            </form>
        </div>
    </div>
@endsection
