<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leaderboard;

class LeaderboardSeeder extends Seeder
{
    public function run(): void
    {
        $leaderboard = [
            ['name' => 'David Beckham', 'steps' => 120500],
            ['name' => 'Sarah Jenkins', 'steps' => 115200],
            ['name' => 'Marcus Thorne', 'steps' => 98400],
            ['name' => 'Elena Rodriguez', 'steps' => 92100],
            ['name' => 'Kevin Hart', 'steps' => 88300]
        ];

        foreach ($leaderboard as $entry) {
            Leaderboard::create($entry);
        }
    }
}