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

    public function index(Request $request)
    {
        $page = $request->get('page') ?? 1;
        $search = $request->get('search') ?? '';
        return $this->planetRepository->get($page, $search);
    }

    public function getPlanetData($id)
    {
        return (array)$this->planetRepository->getPlanet($id);
    }
}
