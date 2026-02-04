<?php

use App\Models\User;

use function Pest\Laravel\post;

it('can create an account', function () {
    post(route('register.store'), [
        'name' => 'Max Mustermann',
        'email' => 'max@mustermann.de',
        'password' => 'password',
    ])->assertRedirect(route('dashboard'));

    $this->assertAuthenticated();

    expect(User::where('email', 'max@mustermann.de')->exists())->toBeTrue();
});

it('it rejects invalid input', function () {
    post(route('register.store'), [
        'name' => '',
        'email' => 'keine-echte-mail',
        'password' => 'pass',
    ])->assertSessionHasErrors(['name', 'email', 'password']);

    $this->assertGuest();
});

it('requires a unique email', function () {
    User::factory()->create(['email' => 'max@mustermann.de']);

    post(route('register.store'), [
        'name' => 'Max Mustermann',
        'email' => 'max@mustermann.de',
        'password' => 'password',
    ])->assertSessionHasErrors(['email']);

    $this->assertGuest();
});

it('redirects already authenticated user', function () {
    $user = User::factory()->create([]);

    $this->actingAs($user)
        ->get(route('register.index'))
        ->assertRedirect(route('dashboard'));
});
