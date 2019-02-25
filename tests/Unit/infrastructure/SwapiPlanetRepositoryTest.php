<?php

namespace Tests\Unit\infrastructure;

use Domain\Planet;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Infrastructure\SwapiPlanetRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SwapiPlanetRepositoryTest extends TestCase
{
    /** @test */
    public function get_200()
    {
        // arrange
        $planet = new Planet(1, 'testName', 'https://swapi.co/api/planets/1/');
        $total = 10;
        $currentPage = 1;
        $expected = new LengthAwarePaginator([$planet], $total, 10, $currentPage);

        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'count' => $total,
                'results' => [['name' => $planet->name, 'url' => $planet->url]]
            ])),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $service = new SwapiPlanetRepository($client);

        // act
        $result = $service->get($currentPage, '');

        // assert
        self::assertEquals($expected, $result);
    }

    /** @test */
    public function get_404()
    {
        $this->expectException(RequestException::class);

        // arrange
        $mock = new MockHandler([
            new Response(404),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $service = new SwapiPlanetRepository($client);

        // act
        $service->get(1, '');
    }
}
