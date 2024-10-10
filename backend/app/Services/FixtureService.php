<?php

namespace App\Services;

use App\Models\Fixture;
use App\Models\Team;
use App\Repositories\FixtureRepository;

class FixtureService
{
    protected FixtureRepository $fixtureRepo;
    public function __construct(FixtureRepository $fixtureRepo)
    {
        $this->fixtureRepo = $fixtureRepo;
    }
    public function createFixturesForTeams(): array
    {
        $teams = Team::all();
        return $this->fixtureRepo->createFixturesForTeams($teams->toArray());
    }

    public function getFixturesForWeek(int $week)
    {
        return $this->fixtureRepo->getFixturesForWeek($week);
    }
    public function getAllFixtures(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->fixtureRepo->getAllFixtures();
    }
}
