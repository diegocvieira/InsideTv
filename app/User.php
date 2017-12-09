<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nome', 'sobrenome', 'email', 'password', 'foto', 'genero', 'tipo_conta', 'capa', 'data_nasc', 'cidade', 'url',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
