<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_order', 'id_user'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "orders";


    /**
     * Set the real Primary key
     * @var string
     */
    protected $primaryKey = "id_order";

    /**
     * Get related user
     */
    public function user(){
        return $this->hasOne('App\User', 'id_user');
    }

    /**
     * Get related items to order
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(){
        return $this->hasMany("App\Order_Item", "id_order");
    }

    /**
     * Insert order items by cart
     * @param $idOrder
     * @param $idUser
     */
    public static function insertOrderItems($idOrder, $idUser, $cartItems){

        foreach($cartItems as $cartItem){
            $idProduct = $cartItem->id_product;
            $idSeller = $cartItem->id_seller;
            $quantity = $cartItem->quantity;
            $provisionInfo = Product_Seller::getPrices($idProduct, $idSeller);
            $orderItem = new Order_Item(['id_order' => $idOrder,
                'id_product' => $idProduct,
                'id_seller' => $idSeller,
                'amount' => $provisionInfo->amount*$quantity,
                'cost' => $provisionInfo->cost*$quantity,
                'quantity' => $quantity]);
            $orderItem->save();
        }
    }

}
