<?php

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
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
});

// update
it('allows owner to update household', function () {
    expect($this->owner->can('update', $this->household))->toBeTrue();
});

it('does not allow member to update household', function () {
    expect($this->member->can('update', $this->household))->toBeFalse();
});

it('does not allow stranger to update household', function () {
    expect($this->stranger->can('update', $this->household))->toBeFalse();
});

it('does not allow guest to update household', function () {
    $this->assertFalse(Gate::forUser(null)->allows('update', $this->household));
});

// delete
it('allows owner to delete household', function () {
    expect($this->owner->can('delete', $this->household))->toBeTrue();
});

it('does not allow member to delete household', function () {
    expect($this->member->can('delete', $this->household))->toBeFalse();
});

it('does not allow stranger to delete household', function () {
    expect($this->stranger->can('delete', $this->household))->toBeFalse();
});

it('does not allow guest to delete household', function () {
    $this->assertFalse(Gate::forUser(null)->allows('delete', $this->household));
});

// view
it('allows owners and members to view household', function () {
    expect($this->owner->can('view', $this->household))->toBeTrue();
    expect($this->member->can('view', $this->household))->toBeTrue();
});

it('does not allow stranger to view household', function () {
    expect($this->stranger->can('view', $this->household))->toBeFalse();
});

it('does not allow guest to view household', function () {
    $this->assertFalse(Gate::forUser(null)->allows('view', $this->household));
});

// create
it('allows registered user to create household', function () {
    expect($this->owner->can('create', $this->household))->toBeTrue();
    expect($this->member->can('create', $this->household))->toBeTrue();
    expect($this->stranger->can('create', $this->household))->toBeTrue();
});
