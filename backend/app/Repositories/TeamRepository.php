<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllTeams(): \Illuminate\Database\Eloquent\Collection
    {
        return Team::all();
    }

    public function findById($id)
    {
        return Team::find($id);
    }
}
