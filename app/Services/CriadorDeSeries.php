<?php

namespace App\Services;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeSeries
{
    public function criarSerie(string $nome_serie, int $qtd_temporadas, int $ep_por_temporada): Serie
    {
        DB::beginTransaction();
        $serie = new Serie();
        $serie->nome = $nome_serie;
        $serie->save();

        for ($i = 1; $i <= $qtd_temporadas; $i++) {
            $this->criarTemporada($serie, $i, $ep_por_temporada);
        }
        DB::commit();
        
        return $serie;
    }

    private function criarTemporada(Serie &$serie, $numero, $ep_por_temporada)
    {
        $temporada = $serie->temporadas()->create([
            'numero' => $numero
        ]);

        for ($i = 1; $i <= $ep_por_temporada; $i++) {
            $this->criarEpisodio($temporada, $i);
        }
    }

    private function criarEpisodio(Temporada &$temporada, $numero)
    {
        $temporada->episodios()->create([
            'numero' => $numero
        ]);
    }
}
