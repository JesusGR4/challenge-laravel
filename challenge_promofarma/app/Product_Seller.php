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
}
