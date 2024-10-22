<?php

namespace App\Http\Controllers;

use App\Models\History; // Import the History model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeoController extends Controller
{

    
public function getGeoData($ip)
{



    try {
        // Call the IP geolocation API
        $response = Http::get("http://ipinfo.io/{$ip}/geo");

        // Check if the request was successful
        if ($response->successful()) {
            // Fetch the data
            $data = $response->json();
            // Store the geolocation data in history
            $this->storeHistory($data, $ip);

            return response()->json($data);
        }

        return response()->json(['error' => 'Unable to fetch geolocation data'], 400);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
    }
}


    public function storeHistory($data, $ip)
    {
        // Save the complete geolocation data in the database using the History model
        History::create([
            'ip' => $ip,
            'city' => $data['city'] ?? null,
            'region' => $data['region'] ?? null,
            'country' => $data['country'] ?? null,
            'postal' => $data['postal'] ?? null,
            'timezone' => $data['timezone'] ?? null,
        ]);
    }

    public function getHistory()
    {
        // Retrieve all history records using the History model
        $history = History::orderBy('created_at', 'desc')->get();

        return response()->json($history);
    }

    // Delete history by ID
    public function deleteHistory($id)
    {
        // Find the history record by its ID
        $history = History::find($id);

        // Check if the record exists
        if (!$history) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Delete the record
        $history->delete();

        // Return a success response
        return response()->json(['message' => 'Record deleted successfully'], 200);
    }


    public function deleteMultipleHistories(Request $request)
{
    \Log::info($request->all()); // Log the entire request to see the content

    $ids = $request->input('ids');

    if (empty($ids) || !is_array($ids)) {
        return response()->json(['message' => 'No IDs provided'], 400);
    }

    History::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Selected records deleted successfully']);
}

}
