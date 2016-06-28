<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $user->shelves()->create([
            'name' => 'Currently Reading',
            'description' => "The books I'm currently reading",
            'slug' => str_slug('Currently Reading'),
        ]);
        $user->shelves()->create([
            'name' => 'Wishlist',
            'description' => 'The books I want to read',
            'slug' => str_slug('Wishlist'),
        ]);
    }
}
