<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\Room;
use App\Models\Task;
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

    $this->task = Task::factory()->create([
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('allows owner to update task', function () {
    $response = $this->actingAs($this->owner)
        ->put(route('tasks.update', $this->task), [
            'title' => 'Testtask neu',
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask neu',
        'room_id' => $this->room->id,
    ]);
});

it('allows member to update task', function () {
    $response = $this->actingAs($this->member)
        ->put(route('tasks.update', $this->task), [
            'title' => 'Testtask neu',
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask neu',
        'room_id' => $this->room->id,
    ]);
});

it('prevents stranger to update task', function () {
    $response = $this->actingAs($this->stranger)
        ->put(route('tasks.update', $this->task), [
            'title' => 'Testtask neu',
        ]);

    $response->assertForbidden();

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('prevents guests to update task', function () {
    $response = $this->actingAsGuest()
        ->put(route('tasks.update', $this->task), [
            'title' => 'Testtask neu',
        ]);

    $response->assertRedirect(route('login'));

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});
