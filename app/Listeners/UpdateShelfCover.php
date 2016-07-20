<?php

namespace App\Listeners;

use App\Events\ShelfUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateShelfCover
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
     * @param  ShelfUpdated  $event
     * @return void
     */
    public function handle(ShelfUpdated $event)
    {
        $shelf = $event->shelf;
    }
}
