<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emissora extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'emissoras';
    protected $fillable = ['nome'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function series(){
        return $this->hasMany('App\Serie');
    }
}
