<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

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


    public function search(Request $request)
    {
        $this->validate($request, [
            'q' => 'required',
        ], ['required' => 'The book title can not be empty.']);

        $query = $request->q;
        $optParams = array(
            'maxResults' => '10',
            'printType' => 'books',
            'orderBy' => 'relevance',
        );
        $volumes = $this->service->volumes->listVolumes($query, $optParams);

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
