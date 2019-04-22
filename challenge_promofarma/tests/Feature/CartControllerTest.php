<?php
/**
 * Created by PhpStorm.
 * User: jesusgr4
 * Date: 22/04/2019
 * Time: 19:28
 */

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
class CartControllerTest extends TestCase
{

    /**
     * Test if get seller amount
     */
    public function testGetSellerAmount(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')->json('GET','/api/cart/getSellerAmount');
        $response->assertStatus(200);
    }

    /**
     * Test if get cart amount
     */
    public function testGetCartAmount(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')->json('GET','/api/cart/getAmountCart');
        $response->assertStatus(200);
    }


    /**
     * Update quantity of a product
     */
    public function testUpdateQuantity(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')->json('POST','/api/cart/updateQuantity', ['id_product' =>1, 'quantity' => 1]);
        $response->assertStatus(200);
    }

    /**
     * Test finish a buy
     */
    public function testCommitBuy(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')->json('GET','/api/cart/commitBuy');
        $response->assertStatus(200);
    }

    /**
     * Test delete Cart
     */
    public function testDeleteCart(){
        $user = User::find(2); // Search user 1
        $response = $this->actingAs($user, 'api')->json('GET','/api/cart/deleteCart');
        $response->assertStatus(200);
    }

}