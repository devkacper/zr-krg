<?php

namespace App\Services;

use GuzzleHttp;

class NBPService
{
    public static $client = null;

    /**
     * Create Http request client instance.
     *
     * @return GuzzleHttp\Client|null
     */
    public static function getClient()
    {
        if(self::$client === null) {
            self::$client = new GuzzleHttp\Client();
        }

        return self::$client;
    }

    /**
     * Get currencies rates from NBP API.
     *
     * @return mixed
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function getCurrenciesRates()
    {
        $client = self::getClient();

        $nbpRequest = $client->request('GET', 'https://api.nbp.pl/api/exchangerates/tables/c');

        $response = json_decode($nbpRequest->getBody(), true);

        return $response;
    }
}
