<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = array('image1', 'image2');

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function invoice_items()
    {
    	return $this->hasOne('App\Models\InvoiceItems');
    }

    public function promotion()
    {
    	return $this->hasOne('App\Models\Promotion');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
}
