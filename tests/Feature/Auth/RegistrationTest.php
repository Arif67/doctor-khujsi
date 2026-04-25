<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('hospital owners can register even if roles are not pre-seeded', function () {
    $response = $this->post('/register', [
        'hospital_name' => 'City Hospital',
        'hospital_location' => 'Dhaka',
        'phone' => '01700000000',
        'email' => 'owner@example.com',
        'owner_name' => 'Owner Name',
        'password' => 'password',
        'password_confirmation' => 'password',
        'terms' => '1',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('status', 'Registration submitted. You can log in after super admin approval.');

    $user = User::where('email', 'owner@example.com')->first();

    expect($user)->not->toBeNull();
    expect($user->hasRole('hospital_owner'))->toBeTrue();
    expect($user->approval_status)->toBe('pending');
});
