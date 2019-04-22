<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class SellerControllerTest extends TestCase
{


    /**
     * Test fail method with no name
     */
    public function testNotValidCreate(){
        $response = $this->json('POST','/api/seller/create',
            ['name' => '']);
        $response->assertStatus(401);
    }

    /**
     * Test validSignUp
     */
    public function testValidCreate(){
        $response = $this->json('POST','/api/seller/create',
            ['name' => Str::random(10)]);
        $response->assertStatus(200);
    }

    /**
     * Test update with name field empty
     */
    public function testNotValidUpdate(){
        $response = $this->json('POST','/api/seller/update',
            ['name' => '', 'id_seller' => 1]);
        $response->assertStatus(500);
    }

    /**
     * Test update with seller id not send
     */
    public function testIdSellerNotFoundUpdate(){
        $response = $this->json('POST','/api/seller/update',
            ['name' => 'Hola']);
        $response->assertStatus(401);
    }

    /**
     * Test update with non existing seller
     */
    public function testSellerNotFoundUpdate(){
        $response = $this->json('POST','/api/seller/update',
            ['name' => 'Hola', 'id_seller' => 1230918230]);
        $response->assertStatus(401);
    }

    /**
     * Test valid update
     */
    public function testValidUpdate(){
        $response = $this->json('POST','/api/seller/update',
            ['name' => 'Seller updated', 'id_seller' => 1]);
        $response->assertStatus(200);
    }

    /**
     * Test update with seller id not send
     */
    public function testIdSellerNotFoundDelete(){
        $response = $this->json('POST','/api/seller/delete',
            []);
        $response->assertStatus(401);
    }

    /**
     * Test update with non existing seller
     */
    public function testSellerNotFoundDelete(){
        $response = $this->json('POST','/api/seller/delete',
            ['id_seller' => 1230918230]);
        $response->assertStatus(401);
    }

    /**
     * Test valid update
     */
    public function testValidDelete(){
        $response = $this->json('POST','/api/seller/delete',
            ['id_seller' => 3]);
        $response->assertStatus(200);
    }


}