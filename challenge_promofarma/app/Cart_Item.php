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
        'id_cart', 'id_product', 'id_seller', 'amount', 'quantity'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "carts_items";


    /**
     * Set the real Primary key
     * @var string
     */
    protected $primaryKey = ['id_cart', 'id_product', 'id_seller'];

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

}
