<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliar extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'avaliacoes';
    protected $fillable = ['serie_id', 'user_id', 'nota'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
