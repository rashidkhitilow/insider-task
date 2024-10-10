<?php

namespace App\Services;

use App\Models\LeagueStanding;
use App\Models\Matches;
use App\Repositories\MatchRepository;

class MatchService
{
    protected MatchRepository $matchRepository;

    public function __construct(MatchRepository $matchRepository)
    {
        $this->matchRepository = $matchRepository;
    }

    public function createMatch($data)
    {
        return $this->matchRepository->create($data);
    }

    public function getMatchesByWeek($week)
    {
        return $this->matchRepository->getByWeek($week);
    }

    public function getAllMatches()
    {
    }
}
