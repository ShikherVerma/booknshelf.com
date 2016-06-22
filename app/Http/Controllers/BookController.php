<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\BookRepository;
use App\Http\Requests;

require_once base_path('vendor/google/apiclient/src/Google/Client.php');
require_once base_path('vendor/google/apiclient/src/Google/Service/Books.php');

class BookController extends Controller
{
    private $users;
    private $books;
    protected $service;

    public function __construct(UserRepository $users, BookRepository $books)
    {
        $this->middleware('auth');

        $client = new \Google_Client();
        $client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
        $client->setDeveloperKey(env('GOOGLE_DEV_KEY'));
        $this->service = new \Google_Service_Books($client);
        $this->users = $users;
        $this->books = $books;
    }

    public function index()
    {
        return view('search');
    }

    public function show($serviceId)
    {
        // 1. get the book from books api using service id
        // 2. create a new book object using the book volume info
        // 3. return newly created book object to user
        // 4. do we want to catch any exception here and do what?g
        $results = $this->service->volumes->get($serviceId);
        $bookInfo = $results['volumeInfo'];

        dd($bookInfo);
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $optParams = array(
            'maxResults' => '10',
            'printType' => 'books',
            'orderBy' => 'relevance',
        );
        $results = $this->service->volumes->listVolumes($query, $optParams);
        $books = [];
        foreach ($results as $item) {
            $bookData = $this->books->extractGoogleVolumeData($item);
            $book = $this->books->findByVolumeIdOrCreate($bookData);
            $authors = [];
            foreach ($book->authors()->get() as $author) {
                $authors[] = $author->name;
            }
            $categories = [];
            foreach ($book->categories()->get() as $category) {
                $categories[] = $category->name;
            }
            // do some formatting here for authors and categories
            // $book->authors() can be not iterable
            $book['authors'] = implode(', ', $authors);
            $book['categories'] = implode(', ', $categories);
            $books[] = $book;
        }
        return view('books', ['books' => json_encode($books)]);

    }
}
