<?php

namespace Tests\Feature;


use App\User;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{

    /**
     * Test if get all orders
     */
    public function testGetOrders(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')->json('GET','/api/order/getOrders');
        $response->assertStatus(200);
    }

    /**
     * Test if money spent
     */
    public function testMoneySpent(){
        $user = User::find(1); // Search user 1
        $response = $this->actingAs($user, 'api')->json('GET','/api/order/getSpentMoney');
        $response->assertStatus(200);
    }
}