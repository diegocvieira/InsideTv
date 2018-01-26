<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListasSerie extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'listas_series';
    protected $fillable = ['serie_id', 'lista_id', 'position'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function serie(){
        return $this->belongsTo('App\Serie');
    }

    public function lista(){
        return $this->belongsTo('App\Lista');
    }
}
