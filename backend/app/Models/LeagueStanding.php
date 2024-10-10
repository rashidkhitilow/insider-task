<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueStanding extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'points', 'played', 'won', 'drawn', 'lost', 'goals_for', 'goals_against', 'goal_difference'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public static function updateLeagueStanding($match): void
    {
        $homeTeam = LeagueStanding::where('team_id', $match->home_team_id)->first();
        $awayTeam = LeagueStanding::where('team_id', $match->away_team_id)->first();

        $homeTeam->played++;
        $awayTeam->played++;

        if ($match->home_team_score > $match->away_team_score) {
            // Home team wins
            $homeTeam->wins++;
            $awayTeam->losses++;
            $homeTeam->points += 3;
        } elseif ($match->home_team_score < $match->away_team_score) {
            // Away team wins
            $awayTeam->wins++;
            $homeTeam->losses++;
            $awayTeam->points += 3;
        } else {
            // Draw
            $homeTeam->draws++;
            $awayTeam->draws++;
            $homeTeam->points++;
            $awayTeam->points++;
        }

        $homeTeam->goals_for += $match->home_team_score;
        $awayTeam->goals_for += $match->away_team_score;

        $homeTeam->goals_against += $match->away_team_score;
        $awayTeam->goals_against += $match->home_team_score;

        $homeTeam->goal_difference = $homeTeam->goals_for - $homeTeam->goals_against;
        $awayTeam->goal_difference = $awayTeam->goals_for - $awayTeam->goals_against;

        $homeTeam->save();
        $awayTeam->save();
    }
}
