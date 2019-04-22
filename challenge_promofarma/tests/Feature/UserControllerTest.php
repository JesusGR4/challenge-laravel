<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    /**
     * Test fail method with no name
     */
    public function testNotValidSignUp(){
        $response = $this->json('POST','/api/auth/signup',
            ['name' => '', 'email' => Str::random(10).'@gmail.com', 'password' => 'asdfasdf']);
        $response->assertStatus(500);
    }

    /**
     * Test validSignUp
     */
    public function testValidSignUp(){
        $response = $this->json('POST','/api/auth/signup',
            ['name' => Str::random(10), 'email' => Str::random(10).'@gmail.com', 'password' => 'asdfasdf']);
        $response->assertStatus(200);
    }

    /**
     * Test if update does not work with no valid info
     */
    public function testNotValidUpdateUser(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')
            ->json('POST','/api/auth/update', ['name' => '']);
        $response->assertStatus(500);
    }


    /**
     * Test if update works fine
     */
    public function testValidUpdateUser(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')
            ->json('POST','/api/auth/update', ['name' => 'Jesus actualizado']);
        $response->assertStatus(200);
    }

    /**
     * Test if update works fine
     */
    public function testDisableUser(){
        $user = User::find(3); // Search user 1
        $response = $this->actingAs($user, 'api')
            ->json('GET','/api/auth/delete');
        $response->assertStatus(200);
    }

}