<?php

namespace App\Services;

use App\Models\Fixture;
use App\Models\LeagueStanding;
use App\Models\Matches;
use App\Models\Team;
use App\Repositories\FixtureRepository;
use App\Repositories\LeagueStandingRepository;
use App\Repositories\MatchRepository;

class LeagueStandingService
{
    protected FixtureRepository $fixtureRepo;
    protected MatchRepository $matchRepo;
    protected LeagueStandingRepository $leagueStandingRepository;

    public function __construct(FixtureRepository $fixtureRepo, MatchRepository $matchRepo, LeagueStandingRepository $leagueStandingRepository)
    {
        $this->fixtureRepo = $fixtureRepo;
        $this->matchRepo = $matchRepo;
        $this->leagueStandingRepository = $leagueStandingRepository;
    }



    public function playWeek(int $week)
    {
        $matches = $this->matchRepo->getMatchesForWeek($week);
        foreach ($matches as $match) {
            $this->matchRepo->playMatch($match['id']);
        }

        return $matches;
    }

    public function playAllWeeks()
    {
        $totalWeeks = Fixture::max('week');
        $lastPlayedWeek = Matches::where('status', 'played')->max('week');
        $startWeek = $lastPlayedWeek ? $lastPlayedWeek + 1 : 1;
        for ($week = $startWeek; $week <= $totalWeeks; $week++) {
            $this->playWeek($week);
        }
    }
    public function getStandingsTable()
    {
        return $this->leagueStandingRepository->getStandingsTable();
    }


    public function calculatePredictionsByWeek(int $week)
    {
        // logic
    }

    public function calculateChampionshipPrediction()
    {
        return $this->leagueStandingRepository->calculateChampionshipPrediction();
    }
}
