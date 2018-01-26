<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'series';
    protected $fillable = ['titulo', 'titulo_original', 'sinopse', 'poster', 'data_lancamento', 'trailer', 'emissora_id', 'status', 'capa', 'slug'];
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function avaliacao(){
        return $this->hasMany('App\Avaliar');
    }

    public function avaliar(){
        return $this->hasMany('App\Avaliar');
    }

    public function emissora(){
        return $this->belongsTo('App\Emissora');
    }

    public function sergen(){
        return $this->hasMany('App\Sergen');
    }

    public function lista_serie(){
        return $this->hasMany('App\ListasSerie');
    }

    public function gerarStatus($status){
        switch($status){
            case 0:
                $status = 'Em produção';
                break;
            case 1:
                $status = 'Em andamento';
                break;
            case 2:
                $status = 'Completa';
                break;
            case 3:
                $status = 'Cancelada';
                break;
        }

        return $status;
    }
}
