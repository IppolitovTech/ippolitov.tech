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
        $errors = $this->getThreats($url);

        return empty($errors)
            ? "The link is safe."
            : "The link contains the following threats: " . implode(', ', $errors);
    }

    public function submitForIndexing(Request $request)
    {
        $url = $request->input('url');
        $errors = $this->getThreats($url);

        return empty($errors)
            ? "The URL has been submitted for indexing."
            : "The link contains the following threats: " . implode(', ', $errors);
    }

    private function getThreats($url)
    {
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

        $errors = [];
        if (isset($data->matches)) {
            foreach ($data->matches as $match) {
                $errors[] = $match->threatType;
            }
        }

        return $errors;
    }
}
