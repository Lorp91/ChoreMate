<?php

use App\Models\User;

it('logs out an authenticated user', function () {
    $user = User::factory()->create([]);

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect('/');

    $this->assertGuest();
});
