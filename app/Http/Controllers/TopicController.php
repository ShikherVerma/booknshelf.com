<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'show',
                'all',
            ],
        ]);
    }

    public function all()
    {
        $topics = Topic::all();

        return view('topics', [
            'topics' => json_encode($topics),
        ]);
    }

    public function show($slug)
    {
        $topic = Topic::where('slug', $slug)->firstOrFail();

        $books = $topic->books();

        dd($books);

        return view('topic', [
            'books' => json_encode($books),
        ]);
    }

    public function follow(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:topics,id'
        ]);
        return $request->user()->topics()->attach($request->id);
    }

    public function unfollow(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:topic_user,topic_id'
        ]);
        return $request->user()->topics()->detach($request->id);
    }
}
