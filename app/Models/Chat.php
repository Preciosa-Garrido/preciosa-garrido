<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = array('user_id', 'admin_id', 'gestor_id', 'sender', 'message', 'status', 'state');

    public function admin()
    {
    	return $this->belongsTo('App\Models\Admin', 'admin_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
