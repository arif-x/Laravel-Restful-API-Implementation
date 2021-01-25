<?php

namespace Tests\Feature\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegistersSuccessfully(){
        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->json('post', '/api/register', $payload)->assertStatus(201)->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
                'api_token',
            ],
        ]);
    }

    public function testsRequiresPasswordEmailAndName(){
        $this->json('post', '/api/register')->assertStatus(422)->assertJson([
            'name' => ['The name field is required.'],
            'email' => ['The email field is required.'],
            'password' => ['The password field is required.'],
        ]);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@test.com',
            'password' => '12345678',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'password' => ['The password confirmation does not match.'],
            ]);
    }
}
