<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogNovaSerieCadastradaListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nomeSerie = $event->nomeSerie;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;

        \Log::info('Nova série cadastrada '.$nomeSerie.' - '.$qtdTemporadas.' temporadas e '.$qtdEpisodios.' episodios');
    }
}
