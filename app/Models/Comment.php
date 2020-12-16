<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('product_id', 'user_id', 'full_name', 'email', 'phone', 'message');
}
