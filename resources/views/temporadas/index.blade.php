@extends('layout')

@section('cabecalho')
Temporadas da série {{ $temporadas[0]->serie->nome }}
@endsection

@section('corpo')


<ul class="list-group">
    @foreach ($temporadas as $temporada)
        <li class="list-group-item d-flex justify-content-between">
            <a href="{{ route('temporadas.episodios', $temporada->id) }}">
                <b>Temporada {{ $temporada->numero }}</b>
            </a>
            <span class="badge badge-secondary bg-secondary">{{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}</span>
        </li>
    @endforeach
</ul>
@endsection