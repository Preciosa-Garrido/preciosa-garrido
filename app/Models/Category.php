<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = array('category');

    public function products () {
        $this->hasMany('App\Models\Product');
    }
}
