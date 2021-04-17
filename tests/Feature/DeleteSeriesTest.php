<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Serie;
use App\Services\CriadorDeSeries;
use App\Services\RemovedorDeSeries;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteSeriesTest extends TestCase
{

    use RefreshDatabase;
    private Serie $serie;

    protected function setUp() : void
    {
        parent::setUp();
        
        $criadorDeSeries = new CriadorDeSeries();

        $this->serie = $criadorDeSeries->criarSerie(
            "Nova Serie", 
            1, 
            1
        );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDeleteSeries()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);

        

        $removedorDeSeries = new RemovedorDeSeries();

        $nomeSerie = $removedorDeSeries->remover($this->serie->id);

        $this->assertIsString($nomeSerie);

        $this->assertEquals("Nova Serie", $this->serie->nome);

        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
