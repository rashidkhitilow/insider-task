<?php

namespace App\Repositories;

use App\Models\Fixture;
use App\Models\Matches;

class FixtureRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create($data)
    {
        return Fixture::create($data);
    }

    public function createFixturesForTeams(array $teams): array
    {
        $teamsCount = count($teams);
        $fixtures = [];
        $matches = [];
        $week = 1;

        for ($round = 0; $round < $teamsCount - 1; $round++) {
            for ($i = 0; $i < $teamsCount / 2; $i++) {
                $homeTeam = $teams[$i];
                $awayTeam = $teams[$teamsCount - 1 - $i];
                $fixtures[] = Fixture::create([
                    'home_team_id' => $homeTeam['id'],
                    'away_team_id' => $awayTeam['id'],
                    'week' => $week,
                ]);

                $matches[] = Matches::create([
                    'home_team_id' => $homeTeam['id'],
                    'away_team_id' => $awayTeam['id'],
                    'week' => $week,
                    'status' => 'pending',
                ]);

                $fixtures[] = Fixture::create([
                    'home_team_id' => $awayTeam['id'],
                    'away_team_id' => $homeTeam['id'],
                    'week' => $week + ($teamsCount - 1),
                ]);

                $matches[] = Matches::create([
                    'home_team_id' => $awayTeam['id'],
                    'away_team_id' => $homeTeam['id'],
                    'week' => $week + ($teamsCount - 1),
                    'status' => 'pending',
                ]);
            }
            $lastTeam = array_pop($teams);
            array_splice($teams, 1, 0, [$lastTeam]);

            $week++;
        }

        return [$fixtures, $matches];

    }

    public function getFixturesForWeek(int $week)
    {
        return Fixture::with(['homeTeam', 'awayTeam'])->where('week', $week)->get();
    }
    public function getAllFixtures()
    {
        return Fixture::with(['homeTeam', 'awayTeam'])->orderBy('week')->get();
    }
}
