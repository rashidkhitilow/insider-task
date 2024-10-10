<?php

namespace App\Repositories;

use App\Models\LeagueStanding;
use App\Models\Matches;
use Illuminate\Support\Facades\DB;

class MatchRepository
{
    public function getMatchesForWeek(int $week)
    {
        return Matches::where('week', $week)->where('status', 'pending')->get();
    }

    public function playMatch(int $matchId)
    {
        $match = Matches::findOrFail($matchId);
        $match->home_team_score = rand(0, 8);
        $match->away_team_score = rand(0, 8);
        $match->status = 'played';
        $match->save();
        LeagueStanding::updateLeagueStanding($match);
        return $match;
    }
}
