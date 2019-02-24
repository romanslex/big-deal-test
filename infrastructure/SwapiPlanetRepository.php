<?php

namespace Infrastructure;

use Domain\Planet;
use Domain\PlanetRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SwapiPlanetRepository implements PlanetRepositoryInterface
{

    public function get($page): LengthAwarePaginator
    {
        $items = [
            new Planet("Earth", "/1"),
            new Planet("Mars", "/2"),
        ];
        $result = new LengthAwarePaginator($items, 50, 10, 1);
        return $result;
    }
}