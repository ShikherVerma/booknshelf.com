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

    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->users = $users;
    }

    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $client = new \Google_Client();
        $client->setApplicationName("My Application");
        $client->setDeveloperKey("AIzaSyAyW_3rk7sDAGb0pYirC-E7tVQcka_MnY4");

        $service = new \Google_Service_Books($client);

        $optParams = array('filter' => 'free-ebooks');
        $results = $service->volumes->listVolumes($query);
        $books = [];
        foreach ($results as $item) {
            $books[] = $item['volumeInfo'];
        }
        return json_encode($books);
    }
}
