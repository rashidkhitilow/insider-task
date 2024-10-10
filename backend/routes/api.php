<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ProjectController;
Route::middleware(['api', 'auth.basic'])->group(function () {
    Route::post('/league/generate-fixtures', [\App\Http\Controllers\Api\FixtureController::class, 'generateFixtures']);
    Route::get('/league/fixtures', [\App\Http\Controllers\Api\FixtureController::class, 'getAllFixtures']);
    Route::get('/league/fixture/{week}', [\App\Http\Controllers\Api\FixtureController::class, 'getFixturesByWeek']);
    Route::post('/league/play/week/{week}', [\App\Http\Controllers\Api\LeagueStandingController::class, 'playWeek']);
    Route::post('/league/play/all', [\App\Http\Controllers\Api\LeagueStandingController::class, 'playAllWeeks']);
    Route::get('/league/standings-table', [\App\Http\Controllers\Api\LeagueStandingController::class, 'getStandingsTable']);
    Route::post('/league/reset', [\App\Http\Controllers\Api\LeagueStandingController::class, 'resetAllData']);
    Route::get('/league/predictions', [\App\Http\Controllers\Api\LeagueStandingController::class, 'calculateChampionshipPrediction']);
});
