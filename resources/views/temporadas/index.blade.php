@extends('layout')

@section('cabecalho')
Temporadas da série {{ $temporadas[0]->serie->nome }}
@endsection

@section('corpo')

@if($temporadas[0]->serie->capa !== null)
<div class="row mb-2">
    <div class="col-12 text-center">
        <a href="{{ $temporadas[0]->serie->capaUrl }}">
            <img src="{{ $temporadas[0]->serie->capaUrl }}" class="img-thumbnail" style="max-height:500px;" />
        </a>
    </div>
</div>
@endif
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