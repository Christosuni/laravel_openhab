<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SensorDataController extends Controller
{
    public function index()
    {
        // Initialize the HTTP client
        $client = new Client();

        try {
            // Attempt to fetch data from OpenHAB
            $response = $client->request('GET', 'http://10.8.0.110:8080/rest/items/ZWave_Node_013_Sensor_power');
            $data = json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            // Log the error and return an error response
            Log::error('Failed to fetch data from OpenHAB: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch data from OpenHAB.'], 500);
        }

        // Convert the data back to JSON format to save to file
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        
        // Define the JSON file name
        $fileName = 'sensor_data.json';

        // Use Laravel's Storage facade to save the JSON data to a file in the 'public' disk
        Storage::disk('public')->put($fileName, $jsonData);

        // Optionally, return the data as a JSON response
        return response()->json([
            'message' => 'Data successfully fetched and saved to ' . $fileName,
            'data' => $data
        ]);
    }
}
