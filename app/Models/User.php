<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use LevelUp\Experience\Models\Level;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use LevelUp\Experience\Concerns\HasStreaks;
use LevelUp\Experience\Concerns\GiveExperience;
use LevelUp\Experience\Concerns\HasAchievements;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GiveExperience, HasAchievements, HasStreaks, HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'school_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * User role checking methods
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Experience Points System
     */
    public function addPoints(int $amount): void
    {
        $this->experience += $amount;
        $this->save();
    }

    public function deductPoints(int $amount): void
    {
        $this->experience = max(0, $this->experience - $amount);
        $this->save();
    }

    public function setPoints(int $amount): void
    {
        // Implementation of setPoints method
    }

    public function getPoints(): int
    {
        return $this->experience;
    }

    /**
     * Get the user's current level
     *
     * @return int
     */
    public function getLevelAttribute()
    {
        try {
            return Level::getCurrentLevel($this);
        } catch (\Exception $e) {
            return 1; // Default to level 1 if level system is not initialized
        }
    }
}
