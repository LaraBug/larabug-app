<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('login screen can be rendered', function () {

    $response = $this->get(route('login'));
    
    $response->assertViewIs('frontend.login');
    $response->assertStatus(200);
});

test('users can login using the view', function () {

    $user = User::factory()->create();

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('home'));
    $response->assertStatus(302);
});

test('users cannot authenticate with an incorrect password', function () {

    $user = User::factory()->create();

    $response = $this->from(route('login'))->post(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertStatus(302);
    $response->assertSessionHasErrors('email');
    $this->assertTrue(session()->hasOldInput('email'));
    $this->assertFalse(session()->hasOldInput('password'));
});

test('authenticated users get redirected away from /login', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('login'));

    $response->assertRedirect(route('panel.dashboard'));
    $response->assertStatus(302);

    $this->assertAuthenticatedAs($user);
});