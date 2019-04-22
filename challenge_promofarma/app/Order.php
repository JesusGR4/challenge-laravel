<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
     * Insert order items and reduce stock
     * @param $idOrder
     * @param $idUser
     * @param $cartItems
     */
    public static function insertOrderItems($idOrder, $cartItems){

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
            Product_Seller::reduceStock($idProduct, $idSeller, $quantity);
        }
    }

    /**
     * Get orders data by User
     * @return array
     */
    public static function getOrders(){
        $user = Auth::user();
        $orders = $user->orders()->get();
        $data = array();
        foreach($orders as $order){
            $data['id_order'] = $order->id_order;
            $orderItems = $order->orderItems();
            $data['total_amount'] = $orderItems->sum('amount');
            $data['total_cost'] = $orderItems->sum('cost');
            foreach($orderItems->get() as $orderItem){
                $idProduct = $orderItem->id_product;
                $data['order_items'][$idProduct]['id_product'] = $idProduct;
                $data['order_items'][$idProduct]['amount'] = $orderItem->amount;
                $data['order_items'][$idProduct]['cost'] = $orderItem->cost;
                $data['order_items'][$idProduct]['id_seller'] = $orderItem->id_seller;
                $data['order_items'][$idProduct]['quantity'] = $orderItem->quantity;
            }
        }
        return $data;
    }

    /**
     * Get all money spent by User
     * @return mixed
     */
    public static function getMoneySpent(){
        $user = Auth::user();
        $orders = $user->orders()->get();
        $data['spent'] = 0.0;
        foreach($orders as $order) $data['spent'] += $order->orderItems()->sum('amount');
        return $data;
    }

}
