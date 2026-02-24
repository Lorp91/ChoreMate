<?php

namespace App\Actions\Household;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\HouseholdMembership;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateHouseholdAction
{
    public function handle(User $user, array $data)
    {
        return DB::transaction(function () use ($user, $data) {
            $household = Household::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'created_by' => $user->id,
            ]);

            HouseholdMembership::create([
                'household_id' => $household->id,
                'user_id' => $user->id,
                'role' => HouseholdRole::OWNER->label(),
                'status' => MembershipStatus::ACTIVE->label(),
            ]);

            return $household;
        });
    }
}
