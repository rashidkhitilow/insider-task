<?php

namespace App\Interfaces;

interface FixtureRepositoryInterface
{
    public function createFixturesForTeams(array $teams);
    public function getAllFixtures();
    public function getFixturesForWeek(int $week);
    public function create($data);
}
