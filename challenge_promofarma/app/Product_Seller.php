<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Seller extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_product', 'id_seller', 'stock', 'status', 'amount', 'cost'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "products_sellers";

    /**
     * Get related product
     */
    public function product(){
        return $this->hasOne('App\Product', 'id_product');
    }

    /**
     * Get related seller
     */
    public function seller(){
        return $this->hasOne('App\Seller', 'id_seller');
    }

    /**
     * Check if id_product and id_seller fields exists and if they exist in database
     * @param $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function checkFields($request){
        if(!$request->has('id_product')){
            return response()->json([
                'message' => 'Id product needed'], 401);
        }
        if(!$request->has('id_seller')){
            return response()->json([
                'message' => 'Id seller needed'], 401);
        }
        if(!Product::find($request->id_product)){
            return response()->json([
                'message' => 'Product not found'], 401);
        }

        if(!Seller::find($request->id_seller)){
            return response()->json([
                'message' => 'Seller not found'], 401);
        }
        return true;
    }

    public static function exists($request){
        return Product_Seller::where(['id_product' => $request->id_product, 'id_seller' => $request->id_seller])->first();
    }
}