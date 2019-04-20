<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
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
    protected $table = "sellers";


    /**
     * Set the real Primary key
     * @var string
     */
    protected $primaryKey = "id_seller";

    /**
     * Get related product sellers
     */
    public function productSellers(){
        return $this->hasMany("App\Product_Seller");
    }
}
