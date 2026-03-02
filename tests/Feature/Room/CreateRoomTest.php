<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\HouseholdMembership;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->household = Household::factory()->create([
        'created_by' => $this->user->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $this->household->id,
        'user_id' => $this->user->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);
});

it('allows authenticated user to create room', function () {
    $response = $this->actingAs($this->user)
        ->post(route('households.rooms.store', $this->household), [
            'name' => 'Wohnzimmer',
            'household_id' => $this->household->id,
        ]);
    $response->assertRedirect();

    $this->assertDatabaseHas('rooms', [
        'name' => 'Wohnzimmer',
        'household_id' => $this->household->id,
    ]);
});

it('prevents guests to create room', function () {
    $response = $this->actingAsGuest()
        ->post(route('households.rooms.store', $this->household), [
            'name' => 'Wohnzimmer',
            'household_id' => $this->household->id,
        ]);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('rooms', [
        'name' => 'Wohnzimmer',
        'household_id' => $this->household->id,
    ]);
});
