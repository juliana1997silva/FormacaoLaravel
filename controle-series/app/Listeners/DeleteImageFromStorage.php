<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class DeleteImageFromStorage
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
    public function handle(SeriesCreated $event)
    {
        if (isset($event->seriesCover)) {
            $path = 'public/' . $event->seriesCover;

            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }
}
