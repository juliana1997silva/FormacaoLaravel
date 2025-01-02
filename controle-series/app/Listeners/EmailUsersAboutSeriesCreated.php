<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Mail\SeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
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
    public function handle(EventsSeriesCreated $event)
    {
        //enviar e-mail
        $email = new SeriesCreated(
            $event->seriesNome,
            $event->seriesId,
            $event->seriesSeasonQtd,
            $event->seriesEpisodeQtd,

        );
        //enviar o email na hora da requisição
        Mail::to(Auth::user()->email)->send($email);

        //para colocar o email em uma fila para ser enviados apos a requisição
        //  Mail::to(Auth::user()->email)->queue($email);

        //para colocar o email em uma fila para ser enviados apos a requisição e espera o momento que ira ser execultado (Agendar o processamento para enviar os emails)
        
        // $when = now()->addSeconds(2); tempo que devera aguarda entre um email e outro
        // Mail::to(Auth::user()->email)->later($when, $email);


        //enviar para todos os usuarios do sistema

        //  $userList = User::all();
        //  foreach ($userList as $user) {
        //    $email = new SeriesCreated(
        //        $serie->nome,
        //        $serie->id,
        //       $request->seasonQtd,
        //        $request->episodeQtd,
        //    );
        //    Mail::to($user)->send($email);
        //  }
        //  sleep(2); cada e-mail ira ser enviado a cada 2 segundos
    }
}
