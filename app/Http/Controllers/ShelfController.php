<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ShelfRepository;
use App\Shelf;
use Gate;
use DB;

class ShelfController extends Controller
{

    protected $shelves;

    public function __construct(ShelfRepository $shelves)
    {
        $this->middleware('auth');
        $this->shelves = $shelves;
    }

    // get all recently created bookshelves
    public function all()
    {
        return $this->shelves->recent();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $shelf = new Shelf;
        $shelf->name = $request->name;
        $shelf->description = $request->description;
        $shelf->cover = $request->cover;
        $shelf->slug = str_slug($request->name);

        if (Gate::denies('uniqueSlug', $shelf)) {
            $error = ['name' => ['You already have a bookshelf with this name.']];
            return response()->json($error, 403);
        }

        return $request->user()->shelves()->save($shelf);
    }

    // show the user's shelf
    public function show(Request $request, $shelfId)
    {
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        dd($shelf);
        return $shelf;
    }

    public function update(Request $request, $shelfId)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();

        // the shelf name/slug should be unique per user
        $newSlug = str_slug($request->name);
        $count = $request->user()->shelves()->where('slug', $newSlug)->count();
        if ($count != 0 && $newSlug != $shelf->slug) {
            $error = ['name' => ['You already have a bookshelf with this name.']];
            return response()->json($error, 403);
        }

        $this->authorize('update', $shelf);

        $shelf->name = $request->name;
        $shelf->description = $request->description;
        $shelf->cover = $request->cover;
        $shelf->slug = str_slug($request->name);
        $shelf->save();
    }

    public function destroy(Request $request, $shelfId)
    {
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $this->authorize('destroy', $shelf);

        $shelf->delete();
    }

    public function storeBookToShelf(Request $request, $shelfId)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $bookId = $request->id;
        $count = DB::table('book_shelf')->where([
            'shelf_id' => $shelfId,
            'book_id' => $bookId,
        ])->count();

        if ($count > 0) {
            $error = ['name' => ['The book is already in this bookshelf']];
            return response()->json($error, 403);
        }

        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $shelf->books()->attach($bookId);
    }

    public function removeBookFromShelf(Request $request, $shelfId)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $bookId = $request->id;
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $shelf->books()->detach($bookId);
    }

    public function getAllShelfBooks(Request $request, $shelfId)
    {
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $books = [];
        foreach ($shelf->books()->get() as $book) {
            $authors = [];
            foreach ($book->authors()->get() as $author) {
                $authors[] = $author->name;
            }
            foreach ($book->categories()->get() as $category) {
                $categories[] = $category->name;
            }
            $book['authors'] = implode(', ', $authors);
            $book['categories'] = implode(', ', $categories);
            $books[] = $book;
        }
        return response()->json($books);
    }
}
