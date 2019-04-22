<?php
/**
 * Created by PhpStorm.
 * User: jesusgr4
 * Date: 22/04/2019
 * Time: 18:40
 */

namespace Tests\Feature;
use App\Product;
use App\Seller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductSellerControllerTest extends TestCase
{
    /**
     * Test fail method with negative stock
     */
    public function testNotValidCreate(){

        $response = $this->json('POST','/api/provision/create',
            ['stock' => '-1', 'amount' => 12.5, 'cost'=> 10,'id_product' => 1, 'id_seller' => 1]);
        $response->assertStatus(500);
    }

    /**
     * testUpdateProvision
     */
    public function testCreateProvision(){
        $product = DB::table('products')->orderBy('id_product', 'desc')->first();
        $seller = DB::table('sellers')->orderBy('id_seller', 'desc')->first();
        $response = $this->json('POST','/api/provision/create',
            ['stock' => '10', 'amount' => 12.5, 'cost'=> 10,'id_product' => $product->id_product, 'id_seller' => $seller->id_seller]);
        $response->assertStatus(200);
    }

    /**
     * testUpdateProvision
     */
    public function testUpdateProvision(){
        $product = DB::table('products')->orderBy('id_product', 'desc')->first();
        $seller = DB::table('sellers')->orderBy('id_seller', 'desc')->first();
        $response = $this->json('POST','/api/provision/update',
            ['stock' => '10', 'amount' => 11.5, 'cost'=> 10,'id_product' => $product->id_product, 'id_seller' => $seller->id_seller]);
        $response->assertStatus(200);
    }

    /**
     * testDeleteProvision
     */
    public function testDeleteProvision(){
        $product = DB::table('products')->orderBy('id_product', 'desc')->first();
        $seller = DB::table('sellers')->orderBy('id_seller', 'desc')->first();
        $response = $this->json('POST','/api/provision/delete',
            ['id_product' => $product->id_product, 'id_seller' => $seller->id_seller]);
        $response->assertStatus(200);
    }

}