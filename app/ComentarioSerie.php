<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioSerie extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'comentario_series';
    protected $fillable = ['descricao', 'serie_id', 'user_id'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
