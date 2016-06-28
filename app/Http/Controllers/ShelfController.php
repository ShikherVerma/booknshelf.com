<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ShelfRepository;
use App\Shelf;
use Gate;

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

        // $shelf->update($request->all());
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
        $shelf = $request->user()->shelves()->where('id', $shelfId)->firstOrFail();
        $shelf->books()->attach($bookId);
    }
}
