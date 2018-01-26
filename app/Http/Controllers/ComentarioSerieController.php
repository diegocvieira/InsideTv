<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\ComentarioSerie;

class ComentarioSerieController extends Controller{
    public function __construct(ComentarioSerie $comentario_serie){
        $this->comentario_serie = $comentario_serie;
    }

    public function index(Request $request){
        $filtro = $request->get('filtro');
        $offset = $request->get('offset');

        if(isset($filtro)){
            $request->get('filtro') == 'antigo' ? $filtro = 'asc' : $filtro = 'desc';
        }

        else
            $filtro = "desc";

        isset($offset) ? $offset += 10 : $offset = 0;

        $comentarios = $this->comentario_serie::with('user')
            ->where('serie_id', $request->get('serie_id'));

        $contar_results = $comentarios->count();

        $comentarios = $comentarios->orderBy('created_at', $filtro)
            ->limit(10)
            ->offset($offset)
            ->get();

        return view('ajax.ajax-comentarios-serie', compact('comentarios', 'offset', 'contar_results'));
    }

    public function store(Request $request){
        $dataForm = $request->all();

        $comentario = $this->comentario_serie->create($dataForm);

        $user = User::find(Auth::user()->id);

        $return['nome'] = $user->nome . ' ' . $user->sobrenome;
        $return['descricao'] = $comentario->descricao;
        $return['foto'] = "/images/usuarios/" . $user->id . '/' . $user->foto;
        $return['id'] = $comentario->id;

        return json_encode($return);
    }

    public function delete($id){
        $this->comentario_serie->find($id)->delete();

        $return['tipo'] = 'comentario-serie';

        return json_encode($return);
    }

    public function update(Request $request, $id){
        $dataForm = $request->all();

        $this->comentario_serie->find($id)->update($dataForm);

        return json_encode('ok');
    }
}
