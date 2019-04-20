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
        'total_amount'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "carts";


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

    public function cartItems(){
        return $this->hasMany("App\Cart_Item", "id_cart");
    }
}
