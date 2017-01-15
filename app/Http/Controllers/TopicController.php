<?php

namespace App\Http\Controllers;

use App\Repositories\ShelfRepository;
use App\Shelf;
use App\User;

class TopicController extends Controller
{
    protected $shelves;

    public function __construct(ShelfRepository $shelves)
    {
        $this->shelves = $shelves;
    }

    public function show($slug)
    {
        $topic = Shelf::where('slug', $slug)->firstOrFail();

        $books = $this->shelves->books($topic);

        dd($books);
        return view('topic', [
            'shelf' => $topic,
            'books' => json_encode($books),
        ]);
    }

    public function all()
    {
        $user = User::where('username', 'topic')->firstOrFail();

        if (is_null($user)) {
            return collect([]);
        };
        $topics = $this->shelves->forUser($user)->toArray();


        return view('topics', [
            '$topics' => $topics,
        ]);
    }
}
