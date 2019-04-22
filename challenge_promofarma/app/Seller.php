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
        'id_seller', 'name', 'status'
    ];

    /**
     * Set the table
     * @var string
     */
    protected $table = "sellers";

    const disabled = 0;
    const active = 1;

    /**
     * Set the real Primary key
     * @var string
     */
    protected $primaryKey = "id_seller";

    /**
     * Get related product sellers
     */
    public function productSellers(){
        return $this->hasMany("App\Product_Seller", "id_seller");
    }

    /**
     * We are going to set as 0 seller status and we are going to disable all related products
     * @var string
     */
    public static function disableSeller($idSeller){
        Product_Seller::where('id_seller', $idSeller)->update(['status' => Seller::disabled]);
    }
}
