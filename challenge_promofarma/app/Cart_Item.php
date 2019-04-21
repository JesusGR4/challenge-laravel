<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_cart', 'id_product', 'id_seller', 'quantity'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "carts_items";



    /**
     * Get related cart
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart(){
        return $this->hasOne('App\Cart', 'id_cart');
    }

    /**
     * Get related seller
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seller(){
        return $this->hasOne('App\Seller', 'id_seller');
    }

    /**
     * Get related product
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product(){
        return $this->hasOne('App\Product', 'id_product');
    }

    /**
     * @param $idProduct
     * @return \Illuminate\Http\JsonResponse
     */
    public static function deleteProduct($idProduct, $idCart){
        $cartItem = Cart_Item::where('id_product', $idProduct)->where('id_cart', $idCart)->first();
        if(!$cartItem){
            return response()->json([
                'message' => 'Item not found in cart'], 401);
        }
        $cartItem->delete();
        return response()->json([
            'message' => 'Item deleted'], 400);
    }

}
