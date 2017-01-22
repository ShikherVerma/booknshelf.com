<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use App\Services\AmazonProduct;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $users;
    private $books;

    public function __construct(UserRepository $users, BookRepository $books)
    {
        $this->middleware('auth', ['except' => ['search']]);
        $this->users = $users;
        $this->books = $books;
    }

    public function search(Request $request, AmazonProduct $amazonService)
    {
        $this->validate($request, [
            'q' => 'required',
        ], ['required' => 'The book title can not be empty.']);

        $query = $request->q;

        $amazonBooks = $amazonService->searchBooks($query);
        $books = [];
        foreach ($amazonBooks as $book) {
            $extractedBook = $this->books->extractAmazonBookData($book);
            $newBook = $this->books->findByAsinOrCreate($extractedBook);
            $newBook->load('authors');
            $books[] = $newBook->toArray();
        }
        // $mostSavedBooks = $this->books->getMostSaved();

        return view('search', [
            'books' => json_encode($books),
            'user' => $request->user(),
            'q' => $query
        ]);
    }
}
