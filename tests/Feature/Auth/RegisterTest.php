<?php

use App\Models\User;

use function Pest\Laravel\post;

it('can create an account', function () {
    post(route('register'), [
        'name' => 'Max Mustermann',
        'email' => 'max@mustermann.de',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirect(route('households.index'));

    $this->assertAuthenticated();

    expect(User::where('email', 'max@mustermann.de')->exists())->toBeTrue();
});

it('it rejects invalid input', function () {
    post(route('register'), [
        'name' => '',
        'email' => 'keine-echte-mail',
        'password' => 'pass',
    ])->assertSessionHasErrors(['name', 'email', 'password']);

    $this->assertGuest();
});

it('requires a unique email', function () {
    User::factory()->create(['email' => 'max@mustermann.de']);

    post(route('register'), [
        'name' => 'Max Mustermann',
        'email' => 'max@mustermann.de',
        'password' => 'password',
    ])->assertSessionHasErrors(['email']);

    $this->assertGuest();
});

it('redirects already authenticated user', function () {
    $user = User::factory()->create([]);

    $this->actingAs($user)
        ->get(route('register'))
        ->assertRedirect(route('households.index'));
});
