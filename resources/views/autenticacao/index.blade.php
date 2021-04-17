@extends('layout')

@section('cabecalho')
    Faça seu login aqui!
@endsection

@section('corpo')
    
    <form method="post" action="{{ route('autenticacao.login.efetuar') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@exemplo.com">
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" class="form-control" placeholder="*********">
            </div>
        <button class="btn btn-primary mt-4">Fazer Login</button>
        <a href="{{ route('autenticacao.cadastro') }}" class="btn btn-secondary mt-4">Nova Conta</a>
    </form>
@endsection