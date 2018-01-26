<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'listas';
    protected $fillable = ['descricao', 'user_id'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function user(){
        return $this->hasMany('App\User');
    }

    public function series(){
        return $this->hasMany('App\Serie');
    }

    public function listas_serie(){
        return $this->hasMany('App\ListasSerie');
    }
}
