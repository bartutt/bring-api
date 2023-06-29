<?php


namespace App\Services;

use GuzzleHttp\Client;


class BringApiService
{

    private $apiUrl = 'https://api.bring.com/address/api';
    private $client;
    private $contryCode;

    
    public function __construct(array $config = []){

        $this->contryCode = $config['countryCode'] ?? 'no';
        $this->client = new Client();
    }


    public function get(string $resource = '', $queryArgs = [], $headers = [])
    {
        $defaultQueryArgs = [];
        $defaultHeaders =  [
            'X-Mybring-API-Uid' => getenv('BRING_API_USER'),
            'X-Mybring-API-Key' => getenv('BRING_API_KEY')
        ];


        $args = [
            'query' => array_merge($defaultQueryArgs, $queryArgs),
            'headers' => array_merge($defaultHeaders, $headers),
        ];

        $response = $this->client->request(
            'GET',
            $this->apiUrl . '/' . $this->contryCode. '/' . $resource,
            $args
        );

        $body = json_decode($response->getBody()->getContents());

        return $body;
    }

    
}
