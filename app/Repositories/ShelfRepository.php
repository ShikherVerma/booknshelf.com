<?php

namespace App\Repositories;

use App\User;
use App\Shelf;

class ShelfRepository {

    public function recent()
    {
        return Shelf::with('user')->orderBy('created_at', 'desc')->take(10)->get();
    }

    /**
     * Get all of the shelves for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->shelves()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}