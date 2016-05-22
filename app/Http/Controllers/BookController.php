<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests;

require_once base_path('vendor/google/apiclient/src/Google/Client.php');
require_once base_path('vendor/google/apiclient/src/Google/Service/Books.php');

class BookController extends Controller
{
    private $users;
    protected $service;

    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');

        $client = new \Google_Client();
        $client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
        $client->setDeveloperKey(env('GOOGLE_DEV_KEY'));
        $this->service = new \Google_Service_Books($client);
        $this->users = $users;
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
            'projection' => 'full',
        );
        $results = $this->service->volumes->listVolumes($query, $optParams);
        $books = [];
        foreach ($results as $item) {
            $books[] = [
                'id' => $item['id'],
                'title' => $item['volumeInfo']['title'],
                'subtitle' => $item['volumeInfo']['subtitle'],
                'description' => $item['volumeInfo']['description'],
                'authors' => $item['volumeInfo']['authors'],
                'published_date' => $item['volumeInfo']['publishedDate'],
                'info_link' => $item['volumeInfo']['infoLink'],
                'image' => $item['volumeInfo']['imageLinks']['thumbnail'],
                'rating' => $item['volumeInfo']['averageRating'],
                'ratings_count' => $item['volumeInfo']['ratingsCount'],
            ];
        }

        return view('search.book-list', ['books' => $books]);
    }
}
