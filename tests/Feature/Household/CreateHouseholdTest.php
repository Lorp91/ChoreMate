<?php

use App\Models\User;

it('allows authenticated user to create household', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('households.store'), [
            'name' => 'Testwohnung',
        ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('households', [
        'name' => 'Testwohnung',
        'created_by' => $user->id,
    ]);
});

it('prevents guests to create household', function () {
    $user = User::factory()->create();

    $response = $this->actingAsGuest()
        ->post(route('households.store'), [
            'name' => 'Testwohnung',
            'created_by' => $user->id,
        ]);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('households', [
        'name' => 'Testwohnung',
        'created_by' => $user->id,
    ]);
});
