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
        // get the user from the event first and create the default shelves
        // if user does not have any shelves yet
        $user = $event->user;
        if ($user->shelves()->get()->count() == 0) {
            $shelf1 = $user->shelves()->create([
                'name' => "Currently Reading",
                'description' => "The books I'm currently reading",
                'slug' => str_slug('currently reading'),
            ]);
            $shelf2 = $user->shelves()->create([
                'name' => "Books I Have Read",
                'description' => "The books I've read in the past",
                'slug' => str_slug('Books I Have Read'),
            ]);
            $shelf3 = $user->shelves()->create([
                'name' => 'Books I Want to Read',
                'description' => 'The books I want to read',
                'slug' => str_slug('Books I want to read'),
            ]);

            dispatch((new UpdateShelfCover($shelf1))->onQueue('shelves_cover'));
            dispatch((new UpdateShelfCover($shelf2))->onQueue('shelves_cover'));
            dispatch((new UpdateShelfCover($shelf3))->onQueue('shelves_cover'));
        }
    }
}
