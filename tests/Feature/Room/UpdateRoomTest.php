<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\HouseholdMembership;
use App\Models\Room;
use App\Models\User;

beforeEach(function () {
    $this->owner = User::factory()->create();
    $this->member = User::factory()->create();
    $this->stranger = User::factory()->create();

    $this->household = Household::factory()->create([
        'created_by' => $this->owner->id,
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $this->household->id,
        'user_id' => $this->owner->id,
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    HouseholdMembership::factory()->create([
        'household_id' => $this->household->id,
        'user_id' => $this->member->id,
        'role' => HouseholdRole::MEMBER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->room = Room::factory()->create([
        'name' => 'Wohnzimmer',
        'household_id' => $this->household->id,
    ]);

    $this->assertDatabaseHas('rooms', [
        'id' => $this->room->id,
        'name' => 'Wohnzimmer',
    ]);
});

it('allows owner to update room', function () {
    $response = $this->actingAs($this->owner)
        ->patch(route('rooms.update', $this->room), [
            'name' => 'Wohnzimmer neu',
        ]);
    $response->assertRedirect();

    $this->assertDatabaseHas('rooms', [
        'id' => $this->room->id,
        'name' => 'Wohnzimmer neu',
    ]);
});

it('prevent member to update room', function () {
    $response = $this->actingAs($this->member)
        ->patch(route('rooms.update', $this->room), [
            'name' => 'Wohnzimmer neu',
        ]);
    $response->assertForbidden();

    $this->assertDatabaseHas('rooms', [
        'id' => $this->room->id,
        'name' => 'Wohnzimmer',
    ]);
});

it('prevent stranger to update room', function () {
    $response = $this->actingAs($this->stranger)
        ->patch(route('rooms.update', $this->room), [
            'name' => 'Wohnzimmer neu',
        ]);
    $response->assertForbidden();

    $this->assertDatabaseHas('rooms', [
        'id' => $this->room->id,
        'name' => 'Wohnzimmer',
    ]);
});

it('prevent guest to update room', function () {
    $response = $this->actingAsGuest()
        ->patch(route('rooms.update', $this->room), [
            'name' => 'Wohnzimmer neu',
        ]);
    $response->assertRedirect(route('login'));

    $this->assertDatabaseHas('rooms', [
        'id' => $this->room->id,
        'name' => 'Wohnzimmer',
    ]);
});
