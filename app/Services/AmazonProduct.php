<?php

namespace App\Services;

use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Search;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use ApaiIO\Request\GuzzleRequest;

class AmazonProduct
{

    private $searchClient;
    private $apaiIoClient;

    public function __construct()
    {
        $conf = new GenericConfiguration();
        $client = new Client();
        $request = new GuzzleRequest($client);

        $conf->setCountry('com')
            ->setAccessKey('AKIAJ37KBMWRKAZ6EYSA')
            ->setSecretKey('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')
            ->setAssociateTag('booknshelf08-20')
            ->setRequest($request);

        $this->searchClient = new Search();
        $this->searchClient->setCategory('Books');
        $this->apaiIoClient = new ApaiIO($conf);
    }

    public function searchBooks($title)
    {
        $books = [];
        $this->searchClient->setKeywords($title);
        $this->searchClient->setResponsegroup(['Large', 'Images']);
        $response = $this->apaiIoClient->runOperation($this->searchClient);
        $jsonResponse = $this->convertXmlToJson($response);

        if (!empty($jsonResponse['Items']['Item'])) {
            $books = $jsonResponse['Items']['Item'];
        }
        return $books;
    }

    private function convertXmlToJson($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);
        return json_decode($json, true);
    }
}
