<?php

namespace App\Interfaces;

interface TeamRepositoryInterface
{
    public function getAllTeams();
    public function findById($id);
}
