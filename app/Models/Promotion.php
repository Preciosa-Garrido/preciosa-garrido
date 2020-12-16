<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = array();

    public function products()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
