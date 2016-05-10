<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Shelf;
use App\User;
use Log;

class ShelfPolicy {

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the given user can delete the given shelf.
     *
     * @param  User $user
     * @param  shelf $shelf
     * @return bool
     */
    public function destroy(User $user, Shelf $shelf)
    {
        Log::info("Trying to destroy a shelf for user: " . $user->email);
        return $user->id === $shelf->user_id;
    }
}
