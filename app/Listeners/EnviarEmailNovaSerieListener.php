<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NovaSerie;
use Illuminate\Support\Facades\Mail;
use App\Mail\NovaSerie as NovaSerieMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmailNovaSerieListener implements ShouldQueue
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
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $users = User::all();
        foreach($users as $i => $user){
            $email = new NovaSerieMail(
                $event->nomeSerie,
                $event->qtdTemporadas,
                $event->qtdEpisodios
            );
            $email->subject = "Nova série adcionada";

            $tSeconds = $i * 10;
            $when = now()->addSeconds($tSeconds);
            Mail::to($user)->later(
                $when, 
                $email
            );
        }
    }
}
