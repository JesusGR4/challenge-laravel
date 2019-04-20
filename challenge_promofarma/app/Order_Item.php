<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_order','id_seller', 'id_product', 'pvp_price', 'cost_price', 'quantity'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "orders_items";

    /**
     * Get related order
     */
    public function order(){
        return $this->hasOne('App\Order', 'id_order');
    }

    /**
     * Get related seller
     */
    public function seller(){
        return $this->hasOne('App\Seller', 'id_seller');
    }

    /**
     * Get related product
     */
    public function product(){
        return $this->hasOne('App\Product', 'id_product');
    }

}
