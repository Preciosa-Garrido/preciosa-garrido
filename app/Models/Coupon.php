<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = array('code', 'desconto');

    public function sales()
    {
    	return $this->hasMany('App\Models\Sale');
    }
}
