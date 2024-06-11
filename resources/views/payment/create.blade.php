@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 my-4" >Realizar Pagamento</h2>
                <form action="{{ route('payments.store',$registration->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="value">Valor</label>
                        <input type="text" class="form-control" id="value" name="value" value="{{ $event->price }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="payment_method">Método de Pagamento</label>
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="credit_card">Cartão de Crédito</option>
                            <option value="boleto">Boleto</option>
                            <!-- Adicione outros métodos de pagamento conforme necessário -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-edit mt-3">Efetuar o pagamento</button>
                </form>
            </div>    
        </div>        
    </div>
@endsection