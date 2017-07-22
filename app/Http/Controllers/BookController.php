<?php

namespace App\Http\Controllers;

use App\Book;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use App\Services\AmazonProduct;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class BookController extends Controller
{
    private $users;
    private $books;

    public function __construct(UserRepository $users, BookRepository $books)
    {
        $this->middleware('auth', ['except' => ['search', 'reviews']]);
        $this->guzzleClient = new Client();
        $this->users = $users;
        $this->books = $books;
    }

    public function show(Request $request, $bookId)
    {
        $book = $this->books->findById($bookId);
        $book->load('authors', 'likes');

        return view('book', [
            'book' => $book,
            'user' => $request->user(),
        ]);
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
            $newBook->load('authors', 'likes');
            $books[] = $newBook->toArray();
        }

        return view('search', [
            'books' => json_encode($books),
            'user' => $request->user(),
            'q' => $query,
        ]);
    }

    public function likes(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $likes = $book->likes()->get();

        return response()->json($likes);
    }

    /*
    * Get the reviews from Goodreads for the given book
    */
    public function reviews($bookId)
    {
        $bookIsbn = Book::findOrFail($bookId)->getAttribute('isbn_10');
        if (empty($bookIsbn)) {
            return;
        }

        $res = $this->guzzleClient->request(
            'GET',
            'https://www.goodreads.com/book/review_counts.json?isbns=' . $bookIsbn . '&key=' . getenv('GOODREADS_KEY'));
        $body = json_decode((string)$res->getBody());

        $fullBody = $body->books[0];

        return response()->json($fullBody);
    }

    // get the public notes of the book
    public function notes(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        // get all the public notes
        $notes = $book->notes()->with('user')->where([
            ['is_private', '=', false],
            ['user_id', '<>', $request->user()->id],
        ])->orderBy('created_at', 'desk')->get();
        // get user's private notes of this book if any
        $userNotes = $book->notes()->with('user')->where([
            'user_id' => $request->user()->id
        ])->orderBy('created_at', 'desk')->get();
        return response()->json([
            'public_notes' => $notes,
            'user_notes' => $userNotes,
        ]);
    }
}
