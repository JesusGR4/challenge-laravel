<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{


    /**
     * Test fail method with no name
     */
    public function testNotValidCreate(){
        $response = $this->json('POST','/api/product/create',
            ['name' => '']);
        $response->assertStatus(401);
    }

    /**
     * Test validSignUp
     */
    public function testValidCreate(){
        $response = $this->json('POST','/api/product/create',
            ['name' => Str::random(10)]);
        $response->assertStatus(200);
    }

    /**
     * Test update with name field empty
     */
    public function testNotValidUpdate(){
        $response = $this->json('POST','/api/product/update',
            ['name' => '', 'id_product' => 1]);
        $response->assertStatus(500);
    }

    /**
     * Test update with product id not send
     */
    public function testIdProductNotFoundUpdate(){
        $response = $this->json('POST','/api/product/update',
            ['name' => 'Hola']);
        $response->assertStatus(401);
    }

    /**
     * Test update with non existing product
     */
    public function testProductNotFoundUpdate(){
        $response = $this->json('POST','/api/product/update',
            ['name' => 'Hola', 'id_product' => 1230918230]);
        $response->assertStatus(401);
    }

    /**
     * Test valid update
     */
    public function testValidUpdate(){
        $response = $this->json('POST','/api/product/update',
            ['name' => 'Product updated', 'id_product' => 1]);
        $response->assertStatus(200);
    }

    /**
     * Test update with product id not send
     */
    public function testIdProductNotFoundDelete(){
        $response = $this->json('POST','/api/product/delete',
            []);
        $response->assertStatus(401);
    }

    /**
     * Test update with non existing product
     */
    public function testProductNotFoundDelete(){
        $response = $this->json('POST','/api/product/delete',
            ['id_product' => 1230918230]);
        $response->assertStatus(401);
    }

    /**
     * Test valid update
     */
    public function testValidDelete(){
        $response = $this->json('POST','/api/product/delete',
            ['id_product' => 3]);
        $response->assertStatus(200);
    }


}