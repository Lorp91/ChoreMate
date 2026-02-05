<?php

namespace App\Models;

use App\Enums\HouseholdRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    /** @use HasFactory<\Database\Factories\HouseholdFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // relations

    public function memberships(): HasMany
    {
        return $this->hasMany(HouseholdMembership::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'household_memberships')
            ->withPivot('role', 'status')
            ->withTimestamps();
    }

    public function owner(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'household_memberships')
            ->wherePivot('role', HouseholdRole::OWNER->label())
            ->withPivot('role', 'status')
            ->withTimestamps();
    }
}
