<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lista;
use App\Avaliar;

class AtividadeController extends Controller
{
    public function atividadesSerie(){
        $first = Lista::with(['user' => function($query){
                $query->select('nome');
            }])
            ->where('serie_id', 1)
            ->select('descricao as result1')
            ->selectRaw("'lista' as tabela");

        $atividades = Avaliar::with(['user' => function($query){
                $query->select('nome');
            }])
            ->where('serie_id', 1)
            ->select('nota as result1')
            ->selectRaw("'avaliar' as tabela")
            ->union($first)
            ->get();

        $teste = Avaliar::with('user')->where('serie_id', 1)->get();

        return view('ajax.ajax-atividades-serie', compact('atividades', 'teste'));
    }
}
