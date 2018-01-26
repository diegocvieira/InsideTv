<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sergen extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sergens';
    protected $fillable = ['serie_id', 'genero_id'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function serie(){
        return $this->belongsTo('App\Serie');
    }

    public function genero(){
        return $this->belongsTo('App\Genero');
    }
}
