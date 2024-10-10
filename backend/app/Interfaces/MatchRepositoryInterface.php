<?php

namespace App\Interfaces;

interface MatchRepositoryInterface
{
    public function getMatchesForWeek(int $week);
    public function playMatch(int $matchId);
}
