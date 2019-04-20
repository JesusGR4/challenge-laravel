<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "products";


    /**
     * Set the real Primary key
     * @var string
     */
    protected $primaryKey = "id_product";

    /**
     * Get related product sellers
     */
    public function productSellers(){
        return $this->hasMany("App\Product_Seller", "id_product");
    }

    /**
     * We are going to set as 0 product status and we are going to disable all related products
     * @var string
     */
    public static function disableProduct($idProduct){

    }
}
