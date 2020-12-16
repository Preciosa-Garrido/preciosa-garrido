<?php

namespace App;

use App\Models\Produto;
use App\Models\Historico;
use App\Models\Notificacoes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'foto', 'address', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * CRIANDO FUNÇÕES AUXILIARES
    */

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public function chats()
    {
        return $this->hasMany('App\Models\Chat');
    }
}