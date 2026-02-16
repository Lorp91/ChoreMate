<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\post;

it('logs in users with valid credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('households.index'));

    $this->assertAuthenticatedAs($user);
});

it('rejects invalid credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    post(route('login'), [
        'email' => $user->email,
        'password' => 'pass12345',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('redirects already authenticated user', function () {
    $user = User::factory()->create([]);

    $this->actingAs($user)
        ->get(route('login'))
        ->assertRedirect(route('households.index'));
});
