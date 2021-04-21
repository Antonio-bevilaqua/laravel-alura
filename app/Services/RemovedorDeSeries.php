<?php

namespace App\Services;

use App\Events\SerieApagadaEvent;
use App\Jobs\ExcluirCapaSerie;
use App\Models\Serie;
use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemovedorDeSeries
{
    public function remover($id_serie): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($id_serie, &$nomeSerie) {
            $serie = Serie::find($id_serie);
            $nomeSerie = $serie->nome;

            $serieObj = (object)$serie->toArray();
            
            $this->removerTemporadas($serie);

            $serie->delete();

            ExcluirCapaSerie::dispatch($serieObj);
            
        });
        return $nomeSerie;
    }

    private function removerTemporadas(Serie &$serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada){
            $this->removerEpisodios($temporada);

            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada &$temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio){
            $episodio->delete();
        });
    }
}