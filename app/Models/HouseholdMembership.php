<?php

namespace App\Models;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HouseholdMembership extends Model
{
    /** @use HasFactory<\Database\Factories\HouseholdMembershipFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'household_id',
        'role',
        'status',
    ];

    // relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    // logic

    public function isOwner(): bool
    {
        return $this->role === HouseholdRole::OWNER->label();
    }

    public function isActive(): bool
    {
        return $this->status === MembershipStatus::ACTIVE->label();
    }
}
