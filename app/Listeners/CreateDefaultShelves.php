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
            'name' => "Books I have read",
            'description' => "The books I've read",
            'slug' => str_slug('Books I have read'),
        ]);
        $user->shelves()->create([
            'name' => 'Wishlist',
            'description' => 'The books I want to read',
            'slug' => str_slug('Wishlist'),
        ]);
    }
}
