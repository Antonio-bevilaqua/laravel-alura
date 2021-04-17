<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\CriadorDeSeries;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSeriesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    public function test_create_serie()
    {
        $criadorDeSeries = new CriadorDeSeries();
        $nomeSerie = "nome de teste";
        $seriecriada = $criadorDeSeries->criarSerie($nomeSerie, 1, 1);
        $temporadasCriadas = $seriecriada->temporadas;

        $this->assertInstanceOf(Serie::class, $seriecriada);
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $seriecriada->id, 'numero' => 1]);
        foreach($temporadasCriadas as $temporada){
            $this->assertDatabaseHas('episodios', ['temporada_id' => $temporada->id, 'numero' => 1]);
        }
    }
}
