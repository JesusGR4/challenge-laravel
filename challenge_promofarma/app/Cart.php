<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_cart', 'id_user', 'status'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "carts";

    const notCommited = 0;
    const commited = 1;
    /**
     * Set the real Primary key
     * @var string
     */
    protected $primaryKey = "id_cart";

    /**
     * Get related user
     */
    public function user(){
        return $this->hasOne('App\User', 'id_user');
    }

    /**
     * Get related Cart Items
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartItems(){
        return $this->hasMany("App\Cart_Item", "id_cart");
    }

    /**
     * @param $idUser
     * @return Cart
     * * Get last cart not committed. If it does not exist, we create it
     */
    public static function getCurrentCart($idUser){

        $cart = Cart::where(['id_user'=> $idUser, 'status' => Cart::notCommited])->first();
        if(!$cart){
            $cart = new Cart(['id_user' => $idUser, 'status' => Cart::notCommited]);
            $cart->save();
        }
        return $cart;
    }

    /**
     * Check if id_product fields exists and if they exist in database
     * @param $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function checkProduct($request){
        if(!$request->has('id_product')){
            return response()->json([
                'message' => 'Id product needed'], 401);
        }

        if(!Product_Seller::find(($request->id_product))){
            return response()->json([
                'message' => 'Product not found'], 401);
        }
        return true;
    }
}
