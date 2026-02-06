<?php

namespace App\Policies;

use App\Models\Household;
use App\Models\User;

class HouseholdPolicy
{
    public function view(User $user, Household $household): bool
    {
        return $household->users()
            ->where('users.id', $user->id)
            ->wherePivot('status', 'active')
            ->exists();
    }

    public function manage(User $user, Household $household): bool
    {
        return $household->owner()
            ->where('users.id', $user->id)
            ->wherePivot('status', 'active')
            ->exists();
    }
}
