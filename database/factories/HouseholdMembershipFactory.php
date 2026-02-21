<?php

namespace Database\Factories;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdMembership>
 */
class HouseholdMembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => User::factory(),
            // 'household_id' => Household::factory(),
            'role' => HouseholdRole::MEMBER->label(),
            'status' => MembershipStatus::ACTIVE->label(),
            'invite_token' => Str::upper(Str::random(8)),
        ];
    }

    public function owner(): self
    {
        return $this->state([
            'role' => HouseholdRole::OWNER->label(),
        ]);
    }

    public function invited(): self
    {
        return $this->state([
            'status' => MembershipStatus::INVITED->label(),
        ]);
    }
}
