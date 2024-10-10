<?php

namespace App\Interfaces;

interface LeagueStandingRepositoryInterface
{
    public function playWeek(int $week);
    public function playAllWeeks();
    public function getStandingsTable();
    public function calculatePredictionsByWeek(int $week);
}
