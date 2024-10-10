<?php

namespace Database\Seeders;

use App\Models\LeagueStanding;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
        ]);
        $teams = [
            ['name' => 'Manchester United', 'short_name' => 'MU'],
            ['name' => 'Chelsea', 'short_name' => 'CHE'],
            ['name' => 'Arsenal', 'short_name' => 'ARS'],
            ['name' => 'Liverpool', 'short_name' => 'LIV']
        ];

        $teamDatas = [];
        foreach ($teams as $teamData) {
            $team = Team::create($teamData); // This creates a new Team instance and saves it to the database
            $teamDatas[] = $team; // Store the created Team instance
        }

        foreach ($teamDatas as $team) {
            LeagueStanding::create([
                'team_id' => (int) $team->id,
                'played' => 0,
                'wins' => 0,
                'draws' => 0,
                'losses' => 0,
                'goals_for' => 0,
                'goals_against' => 0,
                'goal_difference' => 0,
                'points' => 0,
            ]);
        }
    }
}
