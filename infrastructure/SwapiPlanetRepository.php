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

    public function get($page, $search): LengthAwarePaginator
    {
        $response = $this->client->get('planets', ['query' => ['page' => $page, 'search' => $search]]);
        $responseBody = json_decode($response->getBody());

        $planets = [];
        foreach ($responseBody->results as $planet) {
            $planets[] = new Planet(
                $this->getPlanetId($planet->url),
                $planet->name,
                $planet->url
            );
        }

        $result = new LengthAwarePaginator($planets, $responseBody->count, 10, $page);
        return $result;
    }

    public function getPlanet($planetId): Planet
    {
        $response = $this->client->get('planets/' . $planetId);
        $responseBody = json_decode($response->getBody());
        return new Planet(
            $this->getPlanetId($responseBody->url),
            $responseBody->name,
            $responseBody->url
        );
    }

    private function getPlanetId($url)
    {
        preg_match(
            '/https:\/\/swapi\.co\/api\/planets\/([1-90]*)\//',
            $url,
            $matches
        );
        return $matches[1];
    }
}