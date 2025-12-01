<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ParcelTrackingService
{
    protected $apiBaseUrl;
    protected $apiKey;

    public function __construct()
    {
        // You can configure these from .env file
        $this->apiBaseUrl = config('services.parcel_tracking.api_url', 'https://api.example.com');
        $this->apiKey = config('services.parcel_tracking.api_key', '');
    }

    /**
     * Track a parcel by tracking number
     *
     * @param string $trackingNumber
     * @return array
     */
    public function trackParcel($trackingNumber)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->apiBaseUrl . '/track', [
                'tracking_number' => $trackingNumber,
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('Parcel tracking API error: ' . $response->body());
                return ['error' => 'Unable to track parcel. Please try again later.'];
            }
        } catch (\Exception $e) {
            Log::error('Parcel tracking exception: ' . $e->getMessage());
            return ['error' => 'An error occurred while tracking the parcel.'];
        }
    }

    /**
     * Fetch data from the API or database fallback
     *
     * @param string $type (customers, receivers, parcels, tracking-updates, parcel-histories)
     * @return array
     */
    public function fetchData($type)
    {
        // Try API first if configured
        if ($this->apiBaseUrl && $this->apiBaseUrl !== 'https://api.example.com' && !empty($this->apiKey)) {
            try {
                $response = Http::timeout(5)->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                ])->get($this->apiBaseUrl . '/' . $type);

                if ($response->successful()) {
                    $data = $response->json();
                    // Handle different response formats
                    if (isset($data['data']) && is_array($data['data'])) {
                        return $data['data'];
                    } elseif (isset($data[$type]) && is_array($data[$type])) {
                        return $data[$type];
                    } elseif (is_array($data)) {
                        return $data;
                    }
                }
            } catch (\Exception $e) {
                Log::warning("API fetch failed for {$type}, falling back to database: " . $e->getMessage());
            }
        }

        // Fallback to database
        try {
            return $this->fetchFromDatabase($type);
        } catch (\Exception $e) {
            Log::error("Database fetch failed for {$type}: " . $e->getMessage());
            return []; // Always return an array, never throw
        }
    }

    /**
     * Fetch data from database as fallback
     *
     * @param string $type
     * @return array
     */
    protected function fetchFromDatabase($type)
    {
        try {
            switch ($type) {
                case 'customers':
                    if (\Schema::hasTable('customers')) {
                        $data = \DB::table('customers')->get()->toArray();
                        return array_map(function($item) {
                            return (array) $item;
                        }, $data);
                    }
                    break;
                
                case 'receivers':
                    if (\Schema::hasTable('receivers')) {
                        $data = \DB::table('receivers')->get()->toArray();
                        return array_map(function($item) {
                            return (array) $item;
                        }, $data);
                    }
                    break;
                
                case 'parcels':
                case 'shipments':
                    if (\Schema::hasTable('shipments')) {
                        $data = \DB::table('shipments')->get()->toArray();
                        return array_map(function($item) {
                            return (array) $item;
                        }, $data);
                    }
                    break;
                
                case 'tracking-updates':
                    if (\Schema::hasTable('tracking_updates')) {
                        $data = \DB::table('tracking_updates')->get()->toArray();
                        return array_map(function($item) {
                            return (array) $item;
                        }, $data);
                    }
                    break;
                
                case 'parcel-histories':
                    // This might need custom logic based on your schema
                    return [];
            }
            
            return [];
        } catch (\Exception $e) {
            Log::error("Database fetch error for {$type}: " . $e->getMessage());
            return [];
        }
    }
}

