<?php

namespace App\Http\Controllers;

use App\Repositories\ShelfRepository;
use App\Shelf;
use App\Topic;
use App\User;
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
        $topics = Topic::withCount(['followers'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('topics', [
            'topics' => json_encode($topics),
        ]);
    }

    public function show(Request $request, ShelfRepository $shelfRepository, $slug)
    {
        $user = User::where(['username' => 'topic'])->firstOrFail();

        // find a shelf that represents this topic
        $shelf = Shelf::where([
            'slug' => $slug,
            'user_id' => $user->getAttribute('id'),
        ])->firstOrFail();
        $books = $shelfRepository->books($shelf);
        // get the topic by slug
        $topic = Topic::withCount('followers')->where(['slug' => $slug])->firstOrFail();
        // get other topic suggestions
        $otherTopics = Topic::withCount('followers')
            ->whereNotIn('id', [$topic->id])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('topic', [
            'topic' => $topic,
            'books' => json_encode($books),
            'user' => $request->user(),
            'otherTopics' => json_encode($otherTopics),
        ]);
    }

    public function follow(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:topics,id',
        ]);

        return $request->user()->topics()->attach($request->id);
    }

    public function unfollow(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:topic_user,topic_id',
        ]);

        return $request->user()->topics()->detach($request->id);
    }

}
