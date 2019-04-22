<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * Test if some required attribute is valid
     */
    public function testValidationLogin(){
        $response = $this->json('POST','/api/auth/login',
            ['email' => 'jesgarrio@gmail.com', 'password' => '', 'remember_me' => true]);
        $response->assertStatus(500);
    }

    /**
     * Test if password does not match
     */
    public function testMissMatching(){
        $response = $this->json('POST','/api/auth/login',
            ['email' => 'jesgarrio@gmail.com', 'password' => 'asdfasdff', 'remember_me' => true]);
        $response->assertStatus(401);
    }

    /**
     * Test if try to login with disabled user
     */
    public function  testDisableUser(){
        $response = $this->json('POST','/api/auth/login',
            ['email' => 'jesus.garcia@miscota.com', 'password' => 'asdfasdf', 'remember_me' => true]);
        $response->assertStatus(401);
    }

    /**
     * Test if password does not match
     */
    public function testCorrectLogin(){
        $response = $this->json('POST','/api/auth/login',
            ['email' => 'jesgarrio@gmail.com', 'password' => 'asdfasdf', 'remember_me' => true]);
        $response->assertStatus(200);
    }


}