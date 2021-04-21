<?php

namespace App\Listeners;

use App\Events\SerieApagadaEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoverArquivoSerieListener implements ShouldQueue
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
    public function handle(SerieApagadaEvent $event)
    {
        if ($event->serie->capa) Storage::delete($event->serie->capa);
    }
}
