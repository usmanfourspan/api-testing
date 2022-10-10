<?php
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

test('it requires name to register a new user', function () {
   $attributes = User::factory()->raw(['name' => null]);
   $response = $this->postJson(route('auth.register'), $attributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
        ->assertJson(['message' => 'The name is required.']);
});

test('it requires email to register a new user', function () {
    $attributes = User::factory()->raw(['email' => null]);
    $response = $this->postJson(route('auth.register'), $attributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
        ->assertJson(['message' => 'The email is required.']);
});

test('it requires password to register a new user', function () {
    $attributes = User::factory()->raw(['password' => null]);
    $response = $this->postJson(route('auth.register'), $attributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
        ->assertJson(['message' => 'The password is required.']);
});

test('it requires a unique email to register a new user', function () {
    $user = User::factory()->create();
    $attributes = User::factory()->raw(['email' => $user->email]);
    $response = $this->postJson(route('auth.register'), $attributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
        ->assertJson(['message' => 'The email has already been taken.']);
});

test('registers a new user', function () {
    $attributes = User::factory()->raw();
    $response = $this->postJson(route('auth.register'), $attributes);
    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJson(['message' => 'The user is created successfully.']);
});

test('login as a user', function () {
    $user = User::factory()->create();
    $response = $this->postJson(route('auth.login'), [
        'email' => $user->email,
        'password' => 'us04bs12'
    ]);
    $response->assertStatus(Response::HTTP_OK)
             ->assertJson(['message' => 'The user is logged in successfully.']);
});
