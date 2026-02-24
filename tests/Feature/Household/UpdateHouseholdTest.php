<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\HouseholdMembership;
use App\Models\User;

it('allows owner to update household', function () {
    $owner = User::factory()->create();
    $household = Household::factory()->create([
        'name' => 'Testhaushalt',
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
        'name' => 'Testhaushalt',
    ]);

    $this->actingAs($owner)
        ->patch(route('households.update', $household), [
            'name' => 'Testhaushalt aber anders',
        ]);

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
        'name' => 'Testhaushalt aber anders',
    ]);
});

it('prevent members to update household', function () {
    $owner = User::factory()->create();
    $member = User::factory()->create();
    $household = Household::factory()->create([
        'name' => 'Testhaushalt',
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);
    HouseholdMembership::factory()->create([
        'household_id' => $household->id,
        'user_id' => $member->id,
        'role' => HouseholdRole::MEMBER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
        'name' => 'Testhaushalt',
    ]);

    $response = $this->actingAs($member)
        ->patch(route('households.update', $household), [
            'name' => 'Testhaushalt aber anders',
        ]);
    $response->assertStatus(403);

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
        'name' => 'Testhaushalt',
    ]);
});

it('prevent guests to update household', function () {
    $owner = User::factory()->create();
    $household = Household::factory()->create([
        'name' => 'Testhaushalt',
        'created_by' => $owner->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $household->id,
        'user_id' => $owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
        'name' => 'Testhaushalt',
    ]);

    $response = $this->actingAsGuest()
        ->patch(route('households.update', $household), [
            'name' => 'Testhaushalt aber anders',
        ]);
    $response->assertRedirect(route('login'));

    $this->assertDatabaseHas('households', [
        'id' => $household->id,
        'name' => 'Testhaushalt',
    ]);
});
