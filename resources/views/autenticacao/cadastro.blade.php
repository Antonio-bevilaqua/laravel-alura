@extends('layout')

@section('cabecalho')
    Faça seu cadastro aqui!
@endsection

@section('corpo')
    
    <form method="post" action="{{ route('autenticacao.cadastro.efetuar') }}">
            @csrf
            <div class="form-group mb-4">
                <label for="name">Nome</label>
                <input type="name" id="name" name="name" class="form-control" placeholder="Seu nome">
            </div>
            <div class="form-group mb-4">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="seuemail@exemplo.com">
            </div>
            <div class="form-group mb-4">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="*********">
            </div>
            <div class="form-group mb-4">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="*********">
            </div>
        <button class="btn btn-primary mt-4">Enviar</button>
        <a href="{{ route('autenticacao.login') }}" class="btn btn-secondary mt-4">Já possuo uma conta</a>
    </form>
@endsection