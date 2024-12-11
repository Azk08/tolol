<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class RajaOngkirService
{
    private $client;
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.rajaongkir.key');
        $this->baseUrl = config('services.rajaongkir.url');
    }

    public function getCities($provinceId = null)
    {
        try {
            $url = $this->baseUrl . 'city';
            $params = [
                'headers' => [
                    'key' => $this->apiKey
                ]
            ];

            if ($provinceId) {
                $params['query'] = ['province' => $provinceId];
            }

            $response = $this->client->get($url, $params);
            $body = json_decode($response->getBody(), true);

            return $body['rajaongkir']['results'];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Cities Error: ' . $e->getMessage());
            return [];
        }
    }

    public function getProvinces()
    {
        try {
            $url = $this->baseUrl . 'province';
            $response = $this->client->get($url, [
                'headers' => ['key' => $this->apiKey]
            ]);

            $body = json_decode($response->getBody(), true);
            return $body['rajaongkir']['results'];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Provinces Error: ' . $e->getMessage());
            return [];
        }
    }

    public function calculateShippingCost($origin, $destination, $weight, $courier)
    {
        try {
            $url = $this->baseUrl . 'cost';
            $response = $this->client->post($url, [
                'headers' => [
                    'key' => $this->apiKey,
                    'content-type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'origin' => $origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            return $body['rajaongkir']['results'][0]['costs'];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Shipping Cost Error: ' . $e->getMessage());
            return [];
        }
    }
}
