<?php

namespace App\Services;

use DB;
use Image;

require_once base_path('vendor/google/apiclient/src/Google/Client.php');
require_once base_path('vendor/google/apiclient/src/Google/Service/Books.php');

class GoogleBooks
{

    protected $service;

    public function __construct()
    {
        $client = new \Google_Client();
        $client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
        $client->setDeveloperKey(env('GOOGLE_DEV_KEY'));
        $this->service = new \Google_Service_Books($client);
    }

    public function listVolumes($title)
    {
        $optParams = array(
            'maxResults' => '10',
            'printType' => 'books',
            'orderBy' => 'relevance',
        );
        return $this->service->volumes->listVolumes($title, $optParams);
    }

    public function getVolume($volumeId)
    {
        return $this->service->volumes->get($volumeId);
    }
}
