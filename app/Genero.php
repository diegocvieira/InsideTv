<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'generos';
    protected $fillable = ['nome'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function series(){
        return $this->hasMany('App\Serie');
    }

    public function sergen(){
        return $this->hasMany('App\Sergen');
    }
}
