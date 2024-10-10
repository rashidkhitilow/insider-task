<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_name'];

    public function homeMatches()
    {
        return $this->hasMany(Matches::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Matches::class, 'away_team_id');
    }

    public function fixturesHome()
    {
        return $this->hasMany(Fixture::class, 'home_team_id');
    }

    public function fixturesAway()
    {
        return $this->hasMany(Fixture::class, 'away_team_id');
    }

    public function leagueStanding()
    {
        return $this->hasOne(LeagueStanding::class);
    }
}
