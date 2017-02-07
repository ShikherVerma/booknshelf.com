<?php

namespace App\Http\Controllers;

use App\Topic;

class TopicController extends Controller
{

    public function show($slug)
    {
        $topic = Topic::where('slug', $slug)->firstOrFail();

        $books = $topic->books();

        dd($books);

        return view('topic', [
            'books' => json_encode($books),
        ]);
    }

    public function all()
    {
        $topics = Topic::all();

        return view('topics', [
            'topics' => json_encode($topics),
        ]);
    }
}
