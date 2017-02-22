<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\UpdateShelfCover;

class CreateDefaultShelves
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // get the user from the event first
        $user = $event->user;
        $shelf1 = $user->shelves()->create([
            'name' => "Books I have read",
            'description' => "The books I've enjoyed reading",
            'slug' => str_slug('Books I have read'),
        ]);
        $shelf2 = $user->shelves()->create([
            'name' => 'Wishlist',
            'description' => 'The books I want to read',
            'slug' => str_slug('Wishlist'),
        ]);

        dispatch((new UpdateShelfCover($shelf1))->onQueue('shelves_cover'));
        dispatch((new UpdateShelfCover($shelf2))->onQueue('shelves_cover'));
    }
}
