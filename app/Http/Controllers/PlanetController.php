<?php

namespace App\Http\Controllers;

use Domain\PlanetRepositoryInterface;
use Illuminate\Http\Request;

class PlanetController extends Controller
{
    /**
     * @var PlanetRepositoryInterface
     */
    private $planetRepository;

    public function __construct(PlanetRepositoryInterface $planetRepository)
    {
        $this->planetRepository = $planetRepository;
    }

    public function index()
    {
        return $this->planetRepository->get(1);
    }
}
