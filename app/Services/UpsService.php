<?php

namespace App\Services\Ups;

use Illuminate\Support\Facades\Http;
use Exception;

class UpsService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $merchantId;

    public function __construct()
    {
        $this->baseUrl = config('services.ups.base_url');
        $this->clientId = config('services.ups.client_id');
        $this->clientSecret = config('services.ups.client_secret');
        $this->merchantId = config('services.ups.merchant_id');
    }

    public function getAuthToken()
    {
        $url = $this->baseUrl . '/security/v1/oauth/token';
        $auth = base64_encode("{$this->clientId}:{$this->clientSecret}");

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'x-merchant-id' => $this->merchantId,
            'Authorization' => "Basic {$auth}",
        ])->post($url, [
            'grant_type' => 'client_credentials',
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception('Failed to get UPS authentication token: ' . $response->body());
    }

    public function trackParcel($trackingNumber, $accessToken)
    {
        
        $url = $this->baseUrl . "/api/track/v1/details/{$trackingNumber}";

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        throw new Exception('Failed to track parcel: ' . $response->body());
    }
}