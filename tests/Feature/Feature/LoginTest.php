<?php

namespace Tests\Feature\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
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

    public function testUserRequiresEmailAndLogin(){
        $this->json('POST', 'api/login')->assertStatus(422)->assertJson([
            'email' => ['The email field is required.'],
            'password' => ['The password field is required.'],
        ]);
    }

    public function testUserLoginsSuccessfully(){
        $user = factory(User::class)->create([
            'email' => 'john.doe@test.com',
            'password' => bcrypt('12345678'),
        ]);

        $payload = ['email' => 'john.doe@test.com', 'password' => '12345678'];

        $this->json('POST', 'api/login', $payload)->assertStatus(200)->assertJsonStructure([
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
}
