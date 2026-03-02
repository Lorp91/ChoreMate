<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\Room;
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
});

// update
it('allows owner to update room', function () {
    expect($this->owner->can('update', $this->room))->toBeTrue();
});

it('does not allow member to update room', function () {
    expect($this->member->can('update', $this->room))->toBeFalse();
});

it('does not allow stranger to update room', function () {
    expect($this->stranger->can('update', $this->room))->toBeFalse();
});

it('does not allow guest to update room', function () {
    $this->assertFalse(Gate::forUser(null)->allows('update', $this->room));
});

// delete
it('allows owner to delete room', function () {
    expect($this->owner->can('delete', $this->room))->toBeTrue();
});

it('does not allow member to delete room', function () {
    expect($this->member->can('delete', $this->room))->toBeFalse();
});

it('does not allow stranger to delete room', function () {
    expect($this->stranger->can('delete', $this->room))->toBeFalse();
});

it('does not allow guest to delete room', function () {
    $this->assertFalse(Gate::forUser(null)->allows('delete', $this->room));
});

// view
it('allows owners and members to view room', function () {
    expect($this->owner->can('view', $this->room))->toBeTrue();
    expect($this->member->can('view', $this->room))->toBeTrue();
});

it('does not allow stranger to view room', function () {
    expect($this->stranger->can('view', $this->room))->toBeFalse();
});

it('does not allow guest to view room', function () {
    $this->assertFalse(Gate::forUser(null)->allows('view', $this->room));
});

// create
it('allows owner to create room', function () {
    expect($this->owner->can('create', [Room::class, $this->household]))->toBeTrue();
});

it('does not allow member to create room', function () {
    expect($this->member->can('create', [Room::class, $this->household]))->toBeFalse();
});

it('does not allow stranger to create room', function () {
    expect($this->stranger->can('create', [Room::class, $this->household]))->toBeFalse();
});
