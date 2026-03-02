<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\Room;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        'room_id' => $this->room->id,
    ]);
});

// update
it('allows owner to update task', function () {
    expect($this->owner->can('update', $this->task))->toBeTrue();
});

it('allow member to update task', function () {
    expect($this->member->can('update', $this->task))->toBeTrue();
});

it('does not allow stranger to update task', function () {
    expect($this->stranger->can('update', $this->task))->toBeFalse();
});

it('does not allow guest to update task', function () {
    $this->assertFalse(Gate::forUser(null)->allows('update', $this->task));
});

// delete
it('allows owner to delete task', function () {
    expect($this->owner->can('delete', $this->task))->toBeTrue();
});

it('does not allow member to delete task', function () {
    expect($this->member->can('delete', $this->task))->toBeFalse();
});

it('does not allow stranger to delete task', function () {
    expect($this->stranger->can('delete', $this->task))->toBeFalse();
});

it('does not allow guest to delete task', function () {
    $this->assertFalse(Gate::forUser(null)->allows('delete', $this->task));
});

// view
it('allows owners and members to view task', function () {
    expect($this->owner->can('view', $this->task))->toBeTrue();
    expect($this->member->can('view', $this->task))->toBeTrue();
});

it('does not allow stranger to view task', function () {
    expect($this->stranger->can('view', $this->task))->toBeFalse();
});

it('does not allow guest to view task', function () {
    $this->assertFalse(Gate::forUser(null)->allows('view', $this->task));
});

// create
it('allows owner to create task', function () {
    expect($this->owner->can('create', [Task::class, $this->household]))->toBeTrue();
});

it('allow member to create task', function () {
    expect($this->member->can('create', [Task::class, $this->household]))->toBeTrue();
});

it('does not allow stranger to create task', function () {
    expect($this->stranger->can('create', [Task::class, $this->household]))->toBeFalse();
});
