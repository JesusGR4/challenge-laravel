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
        'total_amount'
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

    public function cartItems(){
        return $this->hasMany("App\Order_Item", "id_order");
    }
}
