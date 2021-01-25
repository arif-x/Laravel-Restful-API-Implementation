<?php

namespace Tests\Feature\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Contact;

class ContactTest extends TestCase
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

    public function testsContactsAreCreatedCorrectly(){
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'Arif',
            'phone' => '+6282228882543',
        ];

        $this->json('POST', '/api/contact', $payload, $headers)->assertStatus(200)->assertJson(['id' => 1, 'name' => 'Arif', 'phone' => '+6282228882543']);
    }

    public function testsContactsAreUpdatedCorrectly(){
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $contact = factory(Contact::class)->create([
            'name' => 'Arif',
            'phone' => '+6282228882534',
        ]);

        $payload = [
            'name' => 'Arifs',
            'phone' => '+6282228882543',
        ];

        $response = $this->json('PUT', '/api/contact/' . $contact->id, $payload, $headers)->assertStatus(200)->assertJson([ 
            'id' => 1, 
            'name' => 'Arif',
            'phone' => '+6282228882543',
        ]);
    }

    public function testsContactsAreDeletedCorrectly(){
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $contact = factory(Contact::class)->create([
            'name' => 'Arif',
            'phone' => '+6282228882543',
        ]);

        $this->json('DELETE', '/api/contact/' . $contact->id, [], $headers)->assertStatus(204);
    }

    public function testContactsAreListedCorrectly(){
        factory(Contact::class)->create([
            'name' => 'Arif',
            'phone' => '+6282228882543',
        ]);

        factory(Contact::class)->create([
            'name' => 'Arifs',
            'phone' => '+6282228882534',
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/contact', [], $headers)->assertStatus(200)->assertJson([
            ['name' => 'Arifs', 'phone' => '+6282228882534'],
            ['name' => 'Arif', 'phone' => '+6282228882543']
        ])->assertJsonStructure([
            '*' => ['id', 'name', 'phone', 'created_at', 'updated_at'],
        ]);
    }
}
