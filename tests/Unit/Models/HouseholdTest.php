<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\HouseholdMembership;
use App\Models\User;

it('returns only owner in owners relation', function () {
    $owner = User::factory()->create();
    $member = User::factory()->create();
    $household = Household::factory()->create([
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);
    HouseholdMembership::create([
        'household_id' => $household->id,
        'user_id' => $member->id,
        'role' => HouseholdRole::MEMBER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $owners = $household->owners;
    expect($owners)
        ->toHaveCount(1)
        ->and($owners->contains($owner))->toBeTrue()
        ->and($owners->contains($member))->toBeFalse();
});

it('returns owners and members in users relation', function () {
    $owner = User::factory()->create();
    $member = User::factory()->create();
    $household = Household::factory()->create([
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);
    HouseholdMembership::create([
        'household_id' => $household->id,
        'user_id' => $member->id,
        'role' => HouseholdRole::MEMBER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $users = $household->users;
    expect($users)
        ->toHaveCount(2)
        ->and($users->contains($owner))->toBeTrue()
        ->and($users->contains($member))->toBeTrue();
});

it('returns created_by in creator relation', function () {
    $owner = User::factory()->create();
    $member = User::factory()->create();
    $household = Household::factory()->create([
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);
    HouseholdMembership::create([
        'household_id' => $household->id,
        'user_id' => $member->id,
        'role' => HouseholdRole::MEMBER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    expect($household->creator->id)->toBe($owner->id);
});
