@extends('layout')

@section('cabecalho')
Adcionar série
@endsection

@section('corpo')
<form method="post" action="{{route('series.insert')}}">
    @csrf
    <div class="row">
        <div class="col col-6">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" placeholder="Nome da série">
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col col-3">
            <label for="qtd_temporadas">Nº temporadas:</label>
            <input type="number" step="1" class="form-control @error('qtd_temporadas') is-invalid @enderror" id="qtd_temporadas" name="qtd_temporadas" placeholder="Nº temporadas">
            @error('qtd_temporadas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col col-3">
            <label for="ep_por_temporada">Ep. por temporada:</label>
            <input type="number" step="1" class="form-control @error('ep_por_temporada') is-invalid @enderror" id="ep_por_temporada" name="ep_por_temporada" placeholder="Nº episodios">
            @error('ep_por_temporada')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button class="btn btn-primary mt-4">Adcionar</button>
</form>
@endsection