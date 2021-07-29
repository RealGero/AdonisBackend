<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

class RegistrationControllerTest extends TestCase
{
   use RefreshDatabase;

    public function test_for_users_registration()
    {
        // $user = User::find()
        // Passport::actingAs()
       $userData = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => '1234567890',
            'password_confirmation' => '1234567890'

       ];

        $this->json('POST','api/register',$userData,['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJsonStructure([
            "user"=> [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at'
            ],
            "access_token",
            "message"

        ]);
        // $response->assertStatus(201);

    }
}
