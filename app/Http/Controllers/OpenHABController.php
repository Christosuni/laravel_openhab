<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OpenHABController extends Controller
{
    public function fetchSensorData()
    {
        $client = new Client();
        // Replace the URL with your actual OpenHAB REST API endpoint
        $url = 'http://192.168.1.2:8080/rest/items';

        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
            $data = json_decode($response->getBody(), true);
            
            // Do something with the data, like return it as a JSON response
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
