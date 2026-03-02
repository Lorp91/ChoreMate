<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\Room;
use App\Models\User;

beforeEach(function () {
    $this->owner = User::factory()->create();
    $this->member = User::factory()->create();
    $this->stranger = User::factory()->create();

    $this->household = Household::factory()->create([
        'created_by' => $this->owner->id,
    ]);

    $this->household->users()->attach($this->owner->id, [
        'role' => HouseholdRole::OWNER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);
    $this->household->users()->attach($this->member->id, [
        'role' => HouseholdRole::MEMBER->label(),
        'status' => MembershipStatus::ACTIVE->label(),
    ]);

    $this->room = Room::factory()->create([
        'household_id' => $this->household->id,
    ]);
});

it('allows owner to create task', function () {
    $response = $this->actingAs($this->owner)
        ->post(route('households.rooms.tasks.store', [
            $this->household,
            $this->room,
        ]), [
            'title' => 'Testtask',
            'room_id' => $this->room->id,
        ]);
    $response->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('allows member to create task', function () {
    $response = $this->actingAs($this->member)
        ->post(route('households.rooms.tasks.store', [
            $this->household,
            $this->room,
        ]), [
            'title' => 'Testtask',
            'room_id' => $this->room->id,
        ]);
    $response->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('prevents stranger to create task', function () {
    $response = $this->actingAs($this->stranger)
        ->post(route('households.rooms.tasks.store', [
            $this->household,
            $this->room,
        ]), [
            'title' => 'Testtask',
            'room_id' => $this->room->id,
        ]);
    $response->assertForbidden();

    $this->assertDatabaseMissing('tasks', [
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('prevents guests to create task', function () {
    $response = $this->actingAsGuest()
        ->post(route('households.rooms.tasks.store', [
            $this->household,
            $this->room,
        ]), [
            'title' => 'Testtask',
            'room_id' => $this->room->id,
        ]);
    $response->assertStatus(302);

    $this->assertDatabaseMissing('tasks', [
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});
