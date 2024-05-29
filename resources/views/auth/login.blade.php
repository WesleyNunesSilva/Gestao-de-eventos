@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('erro'))
                            <div class="alert alert-danger">{{ $message }}</div>
                        @endif

                        <form  method="POST">
                            @csrf
                            <div class="form-group ">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control " required>
                            </div>

                            <div class="form-group mt-4">
                                <label for="password">Senha</label>
                                <input id="password" name="password" type="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-edit mt-4 btn-block">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection