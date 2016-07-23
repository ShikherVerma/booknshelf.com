<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ShelfRepository;
use App\Events\ShelfUpdated;
use App\Jobs\UpdateShelfCover;
use App\Shelf;
use Gate;
use DB;

class ShelfController extends Controller
{

    protected $shelves;

    public function __construct(ShelfRepository $shelves)
    {
        $this->middleware('auth', ['except' =>
            ['search']
        ]);
        $this->shelves = $shelves;
    }

    public function all()
    {
        return $this->shelves->recent();
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'q' => 'required',
        ]);
        $q = $request->q;

        $result = Shelf::search($q);
        dd($result);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $shelf = new Shelf;
        $shelf->forceFill([
            'name' => $request->name,
            'description' => $request->description,
            'cover' => $request->cover,
            'slug' => $request->name,
        ]);

        if (Gate::denies('uniqueSlug', $shelf)) {
            $error = ['name' => ['You already have a bookshelf with this name.']];
            return response()->json($error, 403);
        }

        return $request->user()->shelves()->save($shelf);
    }

    public function show(Request $request, $shelfId)
    {
        return $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
    }

    public function update(Request $request, $shelfId)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $user = $request->user();
        $shelf = $user->shelves()->where('id', $shelfId)->firstOrFail();
        $newSlug = str_slug($request->name);

        if ($newSlug != $shelf->slug && $this->shelves->exists($user, $request->name)) {
            $error = ['name' => ['You already have a bookshelf with this name.']];
            return response()->json($error, 403);
        }

        $this->authorize('update', $shelf);

        $shelf->update($request->all());
    }

    public function destroy(Request $request, $shelfId)
    {
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $this->authorize('destroy', $shelf);

        $shelf->delete();
    }

    public function storeBook(Request $request, $shelfId)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $bookId = $request->id;
        // TODO: This should be in a repository.
        $count = DB::table('book_shelf')->where([
            'shelf_id' => $shelfId,
            'book_id' => $bookId,
        ])->count();

        if ($count > 0) {
            $error = ['name' => ['This book is already in this bookshelf.']];
            return response()->json($error, 403);
        }

        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $shelf->books()->attach($bookId);

        // Send a job so the cover of the shelf will be updated.
        $this->dispatch(new UpdateShelfCover($shelf));
    }

    public function removeBook(Request $request, $shelfId)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $bookId = $request->id;
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $shelf->books()->detach($bookId);

        $this->dispatch(new UpdateShelfCover($shelf));
    }

    public function getBooks(Request $request, $shelfId)
    {
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $books = $this->shelves->books($shelf);

        return response()->json($books);
    }
}
