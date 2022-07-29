<?php

namespace App\Tests\Feature\Auth;

use App\Models\User;

test('registration screen can be rendered', function () {

    $response = $this->get(route('register'));

    $response->assertViewIs('frontend.register');
    $response->assertStatus(200);
});

test('new users can register', function () {

    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'D&#t@EVMXhfkpx*kLv3F',
        'password_confirmation' => 'D&#t@EVMXhfkpx*kLv3F',
    ]);

    $this->assertAuthenticated();

    $response->assertRedirect(route('panel.dashboard'));
});

test('validation rules are adhered to', function () {

    $response = $this->post(route('register'), [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
});

test('password must require a number as a minimum', function () {

    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors(['password']);
});

test('authenticated users get redirected away from /register', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('register'));

    $response->assertRedirect(route('panel.dashboard'));
    $response->assertStatus(302);

    $this->assertAuthenticatedAs($user);
});