@extends('layout')

@section('cabecalho')
    Episódios da temporada {{ $temporada->numero }} da série {{ $temporada->serie->nome }}
@endsection

@section('corpo')

    <form method="post" action="{{ route('episodios.checaAssistidos', $temporada->id) }}">
        <ul class="list-group">
            @csrf
            @foreach ($temporada->episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between">
                    Episódio {{ $episodio->numero }}
                    <input 
                    type="checkbox" 
                    name="episodios[]" 
                    value="{{ $episodio->id }}" 
                    @guest('usuario') 
                    disabled 
                    @endguest 
                    id="checkbox-{{ $episodio->id }}" 
                    @if ($episodio->assistido) checked @endif>
                </li>
            @endforeach
        </ul>
        @auth('usuario')
        <button class="btn btn-primary mt-4">Salvar Alterações</button>
        @endauth
    </form>
@endsection
