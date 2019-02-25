<?php

namespace Infrastructure;

use Domain\Planet;
use Domain\PlanetRepositoryInterface;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Pagination\LengthAwarePaginator;

class SwapiPlanetRepository implements PlanetRepositoryInterface
{
    /** @var GuzzleClient */
    private $client;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function get($page): LengthAwarePaginator
    {
        $response = $this->client->get('planets', ['query' => ['page' => $page]]);
        $responseBody = json_decode($response->getBody());

        $planets = [];
        foreach ($responseBody->results as $planet) {
            $planets[] = new Planet($planet->name, $planet->url);
        }

        $result = new LengthAwarePaginator($planets, $responseBody->count, 10, $page);
        return $result;
    }

    public function getPlanet($planetId): Planet
    {
        $response = $this->client->get('planets/' . $planetId);
        $responseBody = json_decode($response->getBody());
        return new Planet($responseBody->name, $responseBody->url);
    }
}