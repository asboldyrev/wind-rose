<?php

namespace App\Services\OpenMeteo;

use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Cache;

class Client
{
    public function __construct()
    {
        //
    }

    public function archive(array $params)
    {
        return $this->request('https://archive-api.open-meteo.com/v1/archive', $params);
    }

    public function geocoding(array $params)
    {
        return $this->request('https://geocoding-api.open-meteo.com/v1/search', $params);
    }

    protected function request(string $url, array $query)
    {
        $cache_key = $url . http_build_query($query ?? []);

        if (Cache::has($cache_key)) {
            Cache::put($cache_key, Cache::get($cache_key), 7 * 24 * 60);
            return Cache::get($cache_key);
        }

        $config = compact('query');
        $client = new GuzzleHttpClient($config);

        $response = $client
            ->request('get', $url, $config)
            ->getBody()
            ->getContents();

        Cache::put($cache_key, json_decode($response), 7 * 24 * 60);

        return json_decode($response);
    }
}
