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
        $client->setApplicationName("Booknshelf");
        $client->setDeveloperKey("AIzaSyAyW_3rk7sDAGb0pYirC-E7tVQcka_MnY4");
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
        // 4. do we want to catch any exception here and do what?
        $results = $this->service->volumes->get($serviceId);
        $bookInfo = $results['volumeInfo'];

        dd($bookInfo);
    }

    public function search(Request $request)
    {
        $query = $request->q;


        $optParams = array('filter' => 'free-ebooks');
        $results = $this->service->volumes->listVolumes($query);
        $books = [];
        foreach ($results as $item) {
            $books[] = [
                'title' => $item['volumeInfo']['title'],
                'authors' => $item['volumeInfo']['authors'],
                'service_id' => $item['id']
            ];
        }
        return json_encode($books);
    }
}
