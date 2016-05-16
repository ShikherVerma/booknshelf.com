<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repositories\UserRepository;

use App\Http\Requests;
// if (file_exists(
//     $configPath = '/vendor/google/apiclient/src/Google/Client.php')) {
//     require_once $configPath;
// }

// if (file_exists(
//     $configPath = '/vendor/google/apiclient/src/Google/Service/Books.php')) {
//     require_once $configPath;
// }

require_once base_path('vendor/google/apiclient/src/Google/Client.php');
require_once base_path('vendor/google/apiclient/src/Google/Service/Books.php');

// $client->setApplicationName("My Application");
// $client->setDeveloperKey("AIzaSyAHpivBebHQnitKHN6MTs8fb9nbFNtl3dQ");

class BookController extends Controller
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->users = $users;
    }

    public function search(Request $request)
    {
        $client = new \Google_Client();
        $client->setApplicationName("My Application");
        $client->setDeveloperKey("AIzaSyAyW_3rk7sDAGb0pYirC-E7tVQcka_MnY4");

        $service = new \Google_Service_Books($client);

        $optParams = array('filter' => 'free-ebooks');
        $results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);
        var_dump($results);
        // foreach ($results as $item) {
        //   echo $item['volumeInfo']['title'], "<br /> \n";
        // }

    }
}
