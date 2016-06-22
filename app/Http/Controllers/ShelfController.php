<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ShelfRepository;
use App\Shelf;

class ShelfController extends Controller
{

    protected $shelves;

    public function __construct(ShelfRepository $shelves)
    {
        $this->middleware('auth');
        $this->shelves = $shelves;
    }

    /**
     * Get all of the application's recently created shelves.
     *
     * @return Response
     */
    public function all()
    {
        return $this->shelves->recent();
    }

    /**
     * Create a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        return $request->user()->shelves()->create([
            'name' => $request->name,
            'description' => $request->description,
            'cover_color' => $request->cover_color,
            'slug' => str_slug($request->name),
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($username, $slug)
    {
        $shelf = Shelf::whereSlug($slug)->firstOrFail();
        return $shelf;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shelfId)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $shelf->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $shelfId)
    {
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $this->authorize('destroy', $shelf);

        $shelf->delete();

    }

    public function storeBookToShelf(Request $request, $shelfId, $bookId)
    {
        // $this->validate($request, [
        //     'shelf_id' => 'required',
        //     'book_id' => 'required',
        // ]);
        // $shelfId = $request->shelf_id;
        // $bookId = $request->book_id;
        // $shelf->books->create
        // 1. First we have to make sure that the current user owns/has the bookshelf
        // 2. Add the book to shelf
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $shelf->books()->attach($bookId);
    }
}
