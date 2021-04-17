<?php

namespace App\Services;

use App\Models\Serie;
use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSeries
{
    public function remover($id_serie): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($id_serie, &$nomeSerie) {
            $serie = Serie::find($id_serie);
            $nomeSerie = $serie->nome;
            
            $this->removerTemporadas($serie);

            $serie->delete();
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