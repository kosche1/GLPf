<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LevelUp\Experience\Models\Level;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        // Create initial levels (1-10 for example)
        for ($i = 1; $i <= 10; $i++) {
            Level::firstOrCreate(
                ['level' => $i],
                ['next_level_experience' => $i * 100] // Simple progression, adjust as needed
            );
        }
    }
} 