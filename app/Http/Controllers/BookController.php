<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Services\GoogleBooks;

class BookController extends Controller
{
    private $users;
    private $books;
    protected $service;

    public function __construct(UserRepository $users, BookRepository $books)
    {
        $this->middleware('auth', ['except' => [
            'search'
        ]]);
        $this->users = $users;
        $this->books = $books;
    }

    public function search(Request $request, GoogleBooks $service)
    {
        $this->validate($request, [
            'q' => 'required',
        ], ['required' => 'The book title can not be empty.']);

        $query = $request->q;
        $volumes = $service->listVolumes($query);

        $books = [];
        foreach ($volumes as $volume) {
            $bookData = $this->books->extractGoogleVolumeData($volume);
            $book = $this->books->findByVolumeIdOrCreate($bookData);
            $book->load('categories', 'authors');
            $books[] = $book->toArray();
        }

        $mostSavedBooks = $this->books->getMostSaved();
        return view('books', [
            'books' => json_encode($books),
            'mostSavedBooks' => $mostSavedBooks,
            'q' => $query
        ]);
    }
}
