<?php

use App\Livewire\Settings\Profile;
use App\Models\User;
use Livewire\Livewire;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('profile page is displayed', function () {
    $this->actingAs($user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'address' => '123 Main St',
        'phone_number' => '555-123-4567',
    ]));

    $this->get('/settings/profile')->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@example.com',
        'address' => '123 Main St',
        'phone_number' => '555-123-4567',
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('address', '456 Oak Ave')
        ->set('phone_number', '555-987-6543')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Test User');
    expect($user->email)->toEqual('test@example.com');
    expect($user->address)->toEqual('456 Oak Ave');
    expect($user->phone_number)->toEqual('555-987-6543');
    expect($user->email_verified_at)->toBeNull();
});

test('email verification status is unchanged when email address is unchanged', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'address' => '123 Main St',
        'phone_number' => '555-123-4567',
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Different Name')
        ->set('email', $user->email)
        ->set('address', '456 Oak Ave')
        ->set('phone_number', '555-987-6543')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('user can delete their account', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'address' => '123 Main St',
        'phone_number' => '555-123-4567',
    ]);

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser');

    $response
        ->assertHasNoErrors()
        ->assertRedirect('/');

    expect($user->fresh())->toBeNull();
    expect(auth()->check())->toBeFalse();
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'address' => '123 Main St',
        'phone_number' => '555-123-4567',
    ]);

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser');

    $response->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
});