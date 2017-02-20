<?php

namespace App\Http\Controllers;

use App\Book;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use App\Services\AmazonProduct;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

    public function search(Request $request, AmazonProduct $amazonService)
    {
        $this->validate($request, [
            'q' => 'required',
        ], ['required' => 'The book title can not be empty.']);

        $query = $request->q;

        $amazonBooks = $amazonService->searchBooks($query);
        dd($amazonBooks);

        $books = [];
        foreach ($amazonBooks as $book) {
            $extractedBook = $this->books->extractAmazonBookData($book);
            $newBook = $this->books->findByAsinOrCreate($extractedBook);
            $newBook->load('authors', 'likes');
            $books[] = $newBook->toArray();
        }

        // we need to append likes to the books

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
}
