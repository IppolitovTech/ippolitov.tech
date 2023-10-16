<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GoogleSafeBrowsingController extends Controller
{
    private $apiKey;
    private $clientId;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_SAFE_BROWSING_API_KEY');
        $this->clientId = env('GOOGLE_SAFE_BROWSING_CLIENT_ID');
    }

    public function scanLink(Request $request)
    {
        $url = $request->input('url');

        $client = new Client();

        $response = $client->post("https://safebrowsing.googleapis.com/v4/threatMatches:find?key=$this->apiKey", [
            'json' => [
                'client' => [
                    'clientId' => $this->clientId,
                    'clientVersion' => '1.0',
                ],
                'threatInfo' => [
                    'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING', 'UNWANTED_SOFTWARE', 'POTENTIALLY_HARMFUL_APPLICATION'],
                    'platformTypes' => ['ANY_PLATFORM'],
                    'threatEntryTypes' => ['URL'],
                    'threatEntries' => [
                        ['url' => $url],
                    ],
                ],
            ],
        ]);

        $data = json_decode($response->getBody());

        return isset($data->matches) && count($data->matches) > 0
            ? "The link contains a threat."
            : "The link is safe.";
    }

    public function submitForIndexing(Request $request)
    {
        $url = $request->input('url');

        $client = new Client();

        $response = $client->post("https://safebrowsing.googleapis.com/v4/threatMatches:find?key=$this->apiKey", [
            'json' => [
                'client' => [
                    'clientId' => $this->clientId,
                    'clientVersion' => '1.0',
                ],
                'threatInfo' => [
                    'threatTypes' => [],
                    'platformTypes' => [],
                    'threatEntryTypes' => ['URL'],
                    'threatEntries' => [
                        ['url' => $url],
                    ],
                ],
            ],
        ]);

        $data = json_decode($response->getBody());

        return isset($data->matches) && count($data->matches) === 0
            ? "The URL has been submitted for indexing."
            : "The URL contains a threat and cannot be indexed.";
    }
}
