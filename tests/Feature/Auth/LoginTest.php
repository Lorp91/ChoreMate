<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\post;

it('logs in users with valid credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    post(route('login.store'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($user);
});

it('rejects invalid credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    post(route('login.store'), [
        'email' => $user->email,
        'password' => 'pass12345',
    ])->assertSessionHasErrors('password');

    $this->assertGuest();
});

it('redirects already authenticated user', function () {
    $user = User::factory()->create([]);

    $this->actingAs($user)
        ->get(route('login.index'))
        ->assertRedirect('/dashboard');
});
