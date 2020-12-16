<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = array('user_id', 'name', 'email', 'subject', 'message');

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
