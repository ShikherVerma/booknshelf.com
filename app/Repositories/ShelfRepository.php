<?php

namespace App\Repositories;

use App\User;
use App\Shelf;

class ShelfRepository {

    public function recent()
    {
        return Shelf::with('user')->orderBy('created_at', 'desc')->take(10)->get();
    }

    public function ourPicks()
    {
        // TODO: This should return only the shelves that have at least one book.
        // This also should not return the default shelves?
        return Shelf::with('user')->orderBy('created_at', 'desc')->take(50)->get();
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

    public function exists(User $user, $shelfName)
    {
        return $user->shelves()->where('slug', str_slug($shelfName))->count() > 0;
    }

    public function findBySlug(User $user, $slug)
    {
        return $user->shelves()->where('slug', $slug)->firstOrFail();
    }

    public function findById($id)
    {
        return Shelf::findOrFail($id);
    }

    public function books($shelf)
    {
        $books = $shelf->books()->orderBy('created_at', 'desc')->get();
        $books->load('categories', 'authors');
        return $books->toArray();
    }
}