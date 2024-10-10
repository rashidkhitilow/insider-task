<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Services\FixtureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    protected FixtureService $fixtureService;

    public function __construct(FixtureService $fixtureService)
    {
        $this->fixtureService = $fixtureService;
    }
    public function generateFixtures(): JsonResponse
    {
        return response()->json($this->fixtureService->createFixturesForTeams());
    }
    public function getAllFixtures(): \Illuminate\Http\JsonResponse
    {
        $fixtures = $this->fixtureService->getAllFixtures();
        return response()->json($fixtures);
    }
    public function getFixturesByWeek(int $week): \Illuminate\Http\JsonResponse
    {
        $fixture = $this->fixtureService->getFixturesForWeek($week);
        return response()->json($fixture);
    }
}
