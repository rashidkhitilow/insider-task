<?php

namespace App\Repositories;

use App\Models\Fixture;
use App\Models\LeagueStanding;
use App\Models\Team;

class LeagueStandingRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function calculatePredictionsByWeek(int $week)
    {
        // logic
    }

    public function calculateChampionshipPrediction()
    {
        $standings = LeagueStanding::with('team')->orderBy('points', 'desc')->get();

        $totalPoints = $standings->sum('points');

        if ($totalPoints === 0) {
            return $standings->map(function ($team) {
                return ['team_id' => $team->team_id, 'team' => $team->team->short_name, 'percentage' => 0];
            });
        }

        return $standings->map(function ($team) use ($totalPoints) {
            $percentage = round($team->points / $totalPoints * 100, 2);
            return ['team_id' => $team->team_id, 'team' => $team->team->short_name, 'percentage' => $percentage];
        });
    }

    public function getStandingsTable()
    {
        return LeagueStanding::with('team')->orderBy('points', 'desc')->get();
    }

}
