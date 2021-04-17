<?php

namespace Tests\Unit;

use App\Models\Episodio;
use App\Models\Temporada;
use Tests\TestCase;

class TemporadaTest extends TestCase
{
    private Temporada $temporada;

    protected function setUp() : void
    {
        parent::setUp();
        $temporada = new Temporada();
        $episodio1 = new Episodio();
        $episodio1->assistido = true;

        $episodio2 = new Episodio();
        $episodio2->assistido = false;

        $episodio3 = new Episodio();
        $episodio3->assistido = true;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_watched_episodes()
    {
        

        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();
        $this->assertCount(2, $episodiosAssistidos);
        foreach($episodiosAssistidos as $episodio){
            $this->assertTrue($episodio->assistido);
        }
    }

    public function test_has_episodes()
    {
        $this->assertCount(3, $this->temporada->episodios);
    }
}
