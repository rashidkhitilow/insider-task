<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TeamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected TeamService $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->teamService->getAllTeams());
    }

    public function store(Request $request): JsonResponse
    {
        $team = $this->teamService->createTeam($request->validated());
        return response()->json($team, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $team = $this->teamService->updateTeam($id, $request->validated());
        return response()->json($team);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->teamService->deleteTeam($id);
        return response()->json(null, 204);
    }
}
