<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'household_id',
    ];

    // relations

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
