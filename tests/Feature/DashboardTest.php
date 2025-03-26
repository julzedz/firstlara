<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'address' => '123 Main St',
        'phone_number' => '555-123-4567',
    ]);

    $this->actingAs($user);

    $this->get('/dashboard')->assertStatus(200);
});