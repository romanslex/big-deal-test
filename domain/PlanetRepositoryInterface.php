<?php

namespace Domain;

use Illuminate\Pagination\LengthAwarePaginator;

interface PlanetRepositoryInterface
{
    public function get($page): LengthAwarePaginator;

    public function getPlanet($planetId): Planet;
}