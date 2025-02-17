<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LevelUp\Experience\Models\Experience;

class Level extends Model
{
    protected $fillable = [
        'level',
        'next_level_experience'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }
} 