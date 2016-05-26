<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ShelfRepository;
use App\Shelf;


use Crew\Unsplash;

class ShelfController extends Controller
{

    protected $shelves;

    public function __construct(ShelfRepository $shelves)
    {
        $this->middleware('auth');
        $this->shelves = $shelves;
        \Crew\Unsplash\HttpClient::init([
            'applicationId' => env('UNSPLASH_APPLICATION_ID'),
            'secret'        => env('UNSPLASH_SECRET'),
            'callbackUrl'   => 'booknshelf.com/home'
        ]);
    }

    public function index(Request $request)
    {
        $response = \Crew\Unsplash\Photo::search('travel');
        dd($response);
        // return $response;
        // return $this->shelves->forUser($request->user());
    }

    /**
     * Create a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        return $request->user()->shelves()->create([
            'name' => $request->name,
            'description' => $request->description,
            'cover_picture' => $request->cover_picture,
            'access_type' => 'public',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shelf $shelf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shelf $shelf)
    {
        $shelf->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Shelf $shelf)
    {
        $this->authorize('destroy', $shelf);

        $shelf->delete();

        return redirect('/shelves');
        //
    }
}
