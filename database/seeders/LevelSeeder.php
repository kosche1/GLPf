<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LevelUp\Experience\Models\Level;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        // Create levels 1-100 with exponential XP requirements
        for ($i = 1; $i <= 100; $i++) {
            Level::firstOrCreate(
                ['level' => $i],
                [
                    // Formula: base_xp * (level_multiplier ^ current_level)
                    // This creates an exponential curve where each level requires more XP
                    'next_level_experience' => (int) (100 * (pow(1.1, $i)))
                ]
            );
        }
    }
} 