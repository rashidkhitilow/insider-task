<?php

namespace App\Services;

use App\Repositories\TeamRepository;

class TeamService
{
    protected TeamRepository $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function getAllTeams(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->teamRepository->getAllTeams();
    }

    public function findTeamById($id)
    {
        return $this->teamRepository->findById($id);
    }

    public function createTeam($validated)
    {
    }

    public function deleteTeam(int $id)
    {
    }

    public function updateTeam(int $id, $validated)
    {
    }
}
