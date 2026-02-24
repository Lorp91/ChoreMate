<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\HouseholdMembership;
use App\Models\User;

it('allows owner to delete household', function () {
    $owner = User::factory()->create();
    $household = Household::factory()->create([
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->actingAs($owner)
        ->delete(route('households.destroy', $household));

    $this->assertDatabaseMissing('households', [
        'id' => $household->id,
    ]);
});

it('prevents members to delete household', function () {
    $member = User::factory()->create();
    $household = Household::factory()->create([
        'created_by' => $member->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $household->id,
        'user_id' => $member->id,
        'role' => HouseholdRole::MEMBER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->actingAs($member)
        ->delete(route('households.destroy', $household));

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
    ]);
});

it('prevent guests to delete household', function () {
    $owner = User::factory()->create();
    $household = Household::factory()->create([
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->actingAsGuest()
        ->delete(route('households.destroy', $household));

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
    ]);
});
