<?php

namespace App\Models;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    /** @use HasFactory<\Database\Factories\HouseholdFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];

    // relations

    public function memberships(): HasMany
    {
        return $this->hasMany(HouseholdMembership::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'household_memberships')
            ->withPivot(['role', 'status'])
            ->withTimestamps();
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'household_memberships')
            ->wherePivot('role', HouseholdRole::OWNER->label())
            ->withPivot('role', 'status')
            ->withTimestamps();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // logic

    public function isMember(User $user): bool
    {
        return $this->users()
            ->where('user_id', $user->id)
            ->wherePivot('status', MembershipStatus::ACTIVE->label())
            ->wherePivotIn('role', [
                HouseholdRole::MEMBER->label(),
                HouseholdRole::OWNER->label(),
            ])
            ->exists();
    }

    public function isOwner(User $user): bool
    {
        return $this->users()
            ->where('user_id', $user->id)
            ->wherePivot('role', HouseholdRole::OWNER->label())
            ->exists();
    }
}
