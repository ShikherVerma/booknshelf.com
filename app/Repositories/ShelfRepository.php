<?php

namespace App\Repositories;

use App\User;
use App\Shelf;
use Illuminate\Database\Eloquent\Collection;
use Log;
use Mockery\CountValidator\Exception;
use Illuminate\Http\Request;

require_once base_path('app/Services/Goodreads/GoodreadsAPI.php');

class ShelfRepository {

    public function recent()
    {
        return Shelf::with('user')->orderBy('created_at', 'desc')->take(10)->get();
    }

    /**
     *  Show all the popular shelves created by us.
     *
     * @return \Illuminate\Support\Collection
     */
    public function ourPicks()
    {
        $popularUsername = env('POPULAR_USERNAME') ?? 'booknshelf';
        $user = User::where('username', $popularUsername)->first();
        if (is_null($user)) {
            return collect([]);
        };
        $shelves = $user->shelves()->get();
        $shelves->load('user', 'books');

        return $shelves;
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
                    ->withCount('books')
                    ->get();
    }

    /**
     * Check if the given user has as shelf with the given slug.
     *
     * @param User $user
     * @param $shelfName
     * @return bool
     */
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
        $books->load('authors', 'likes');
        return $books;
    }

    public function getBooksFromGoodreadsShelves($user, $shelves)
    {
        $token = $user->goodreads_oauth_token;
        $tokenSecret = $user->goodreads_oauth_token_secret;
        $goodreadsUserId = $user->goodreads_user_id;
        $obj = new \GoodreadsApi(
            env('GOODREADS_KEY'),
            env('GOODREADS_SECRET'),
            $token,
            $tokenSecret
        );

        $booksByShelves = [];
        foreach ($shelves as $shelf) {
            $name = $shelf['name'];
            $content = $obj->doGet("https://www.goodreads.com/review/list.xml?shelf=$name&v=2&id=$goodreadsUserId");
            $userJsonData = $this->convertXmlToJson($content);
            $reviews = $userJsonData['reviews']['review'];
            foreach ($reviews as $review) {
                $booksByShelves[$name][] = $review['book'];
            }
        }
        return $booksByShelves;
    }

    private function convertXmlToJson($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);
        return json_decode($json, true);
    }
}
