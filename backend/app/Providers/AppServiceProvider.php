<?php

namespace App\Providers;

use App\Interfaces\FixtureRepositoryInterface;
use App\Interfaces\LeagueStandingRepositoryInterface;
use App\Interfaces\MatchRepositoryInterface;
use App\Interfaces\MatchResultRepositoryInterface;
use App\Interfaces\TeamRepositoryInterface;
use App\Repositories\FixtureRepository;
use App\Repositories\LeagueStandingRepository;
use App\Repositories\MatchRepository;
use App\Repositories\MatchResultRepository;
use App\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(MatchRepositoryInterface::class, MatchRepository::class);
        $this->app->bind(LeagueStandingRepositoryInterface::class, LeagueStandingRepository::class);
        $this->app->bind(FixtureRepositoryInterface::class, FixtureRepository::class);
        $this->app->bind(MatchResultRepositoryInterface::class, MatchResultRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
