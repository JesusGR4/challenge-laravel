<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    const disabled = 0;
    const active = 1;


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get related Carts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart(){
        return $this->hasMany('App\Cart', 'id_cart');
    }

    public function orders(){
        return $this->hasMany('App\Order', 'id_order');
    }

    /**
     * Check if user is active
     * @return bool
     */
    public function userAvailable(){
        return $this->status == User::active;
    }


}
