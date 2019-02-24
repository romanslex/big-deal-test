<?php

namespace Infrastructure;

use Domain\Planet;
use Domain\PlanetRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class SwapiPlanetRepository implements PlanetRepositoryInterface
{
    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://swapi.co/api/',
            'timeout'  => 2.0,
        ]);
    }

    public function get($page): LengthAwarePaginator
    {
        $response = $this->client->get('planets', ['query' => ['page' => $page]]);
        $responseBody = json_decode($response->getBody());

        $planets = [];
        foreach($responseBody->results as $planet)
            $planets[] = new Planet($planet->name, $planet->url);

        $result = new LengthAwarePaginator($planets, $responseBody->count, 10, $page);
        return $result;
    }
}