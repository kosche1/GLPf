<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'points',
        'due_date',
        'difficulty'
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(ChallengeSubmission::class);
    }
} 