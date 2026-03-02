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

it('allows owner to delete task', function () {
    $response = $this->actingAs($this->owner)
        ->delete(route('tasks.destroy', $this->task));
    $response->assertRedirect();

    $this->assertDatabaseMissing('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('prevents member to delete task', function () {
    $response = $this->actingAs($this->member)
        ->delete(route('tasks.destroy', $this->task));
    $response->assertForbidden();

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('prevents stranger to delete task', function () {
    $response = $this->actingAs($this->stranger)
        ->delete(route('tasks.destroy', $this->task));
    $response->assertForbidden();

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});

it('prevents guests to delete task', function () {
    $response = $this->actingAsGuest()
        ->delete(route('tasks.destroy', $this->task));
    $response->assertStatus(302);

    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'title' => 'Testtask',
        'room_id' => $this->room->id,
    ]);
});
