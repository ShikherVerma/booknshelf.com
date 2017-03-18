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
            ->orderBy('followers_count', 'desc')
            ->get();

        return view('topics', [
            'topics' => json_encode($topics),
            'title' => 'Find our favorite topics here',
            'description' => 'All topics are curated by us and always up-to-date. Follow the topics that interest you.'
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
            // page properties
            'title' => $shelf->name . ' topic on Booknshelf',
            'description' => $shelf->description,
            'ogImage' => $topic->cover_photo
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
