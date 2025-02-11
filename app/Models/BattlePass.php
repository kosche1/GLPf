<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BattlePass extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'is_premium'
    ];

    public function tiers()
    {
        return $this->hasMany(BattlePassTier::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserBattlePassProgress::class);
    }
} 