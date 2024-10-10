<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\LeagueStandingRepositoryInterface;
use App\Models\LeagueStanding;
use App\Models\Team;
use App\Services\LeagueStandingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueStandingController extends Controller
{
    protected LeagueStandingService $leagueService;

    public function __construct(LeagueStandingService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    public function getStandingsTable(): JsonResponse
    {
        return response()->json($this->leagueService->getStandingsTable());
    }
    public function playWeek($week): JsonResponse
    {
        return response()->json($this->leagueService->playWeek($week));
    }

    public function playAllWeeks(): JsonResponse
    {
        return response()->json($this->leagueService->playAllWeeks());
    }
    public function calculateChampionshipPrediction(): JsonResponse
    {
        return response()->json($this->leagueService->calculateChampionshipPrediction());
    }

    public function resetAllData(): \Illuminate\Http\JsonResponse
    {
        DB::table('matches')->delete();
        DB::table('fixtures')->delete();
        DB::table('league_standings')->delete();

        $teams = Team::all();
        foreach ($teams as $team) {
            LeagueStanding::create([
                'team_id' => (int) $team->id,
                'played' => 0,
                'wins' => 0,
                'draws' => 0,
                'losses' => 0,
                'goals_for' => 0,
                'goals_against' => 0,
                'goal_difference' => 0,
                'points' => 0,
            ]);
        }
        return response()->json(['message' => 'All data reset successfully']);
    }

}
