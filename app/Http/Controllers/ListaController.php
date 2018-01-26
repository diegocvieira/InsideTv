<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lista;
use Auth;
use App\ListasSerie;
use App\Serie;

class ListaController extends Controller
{
    public function __construct(Lista $lista)
    {
        $this->lista = $lista;
    }

    public function store(Request $request)
    {
        //$dataForm = $request->all();

        $lista_id = $request->lista_id;

        $check = Lista::where('user_id', Auth::user()->id)
            ->where('id', $lista_id)
            ->first();

        if($check) {
            $lista_id = $check->id;
        } else {
            $this->lista->user_id = Auth::user()->id;

            if($request->nova_lista != '') {
                $this->lista->descricao = $request->nova_lista;
            } else {
                $this->lista->descricao = $lista_id;
            }

            $this->lista->save();

            $lista_id = $this->lista->id;
        }

        $listas_serie = new ListasSerie;

        ListasSerie::where('serie_id', $request->serie_id)
            //->where('lista_id', $lista_id)
            ->with(['lista.user' => function($e){
                $e->where('user_id', Auth::user()->id);
            }])
            ->delete();

        $listas_serie->serie_id = $request->serie_id;
        $listas_serie->lista_id = $lista_id;

        $listas_serie->save();

        //return json_encode(true);
    }

    public function listar()
    {
        $listas = Lista::with('listas_serie.serie')
            ->with(['listas_serie' => function($query){
                $query->orderBy('position');
            }])
            ->where('user_id', Auth::user()->id)
            ->get();

            $series = Serie::whereNotIn('id', function($query){
                    $query->select('serie_id')->from('listas_series');
                })->pluck('titulo_original', 'id')->all();

        return view('usuario.listas', compact('listas', 'series'));
    }

    public function teste(Request $request)
    {
        $lista = ListasSerie::where('lista_id', $request->lista_id)
            ->where('serie_id', $request->serie_id)
            ->first();

        //Se a série e a lista já existem, muda apenas a posição, senão cria uma nova lista
        if(count($lista) > 0) {
            $lista->position = $request->position;

            $lista->save();
        } else {
            ListasSerie::where('serie_id', $request->serie_id)
                ->with(['lista.user' => function($e){
                    $e->where('user_id', Auth::user()->id);
                }])
                ->delete();

            $lista_serie = new ListasSerie;

            $lista_serie->create($request->all());

            $serie = Serie::find($request->serie_id);

            $return['id'] = $serie->id;
            $return['slug'] = $serie->slug;
            $return['titulo'] = $serie->titulo_original;

            return json_encode($return);
        }
    }

    public function removerSerie(Request $request)
    {
        ListasSerie::where('serie_id', $request->serie_id)
            ->with(['lista.user' => function($e){
                $e->where('user_id', Auth::user()->id);
            }])
            ->delete();
    }

    public function removerLista(Request $request)
    {
        ListasSerie::where('serie_id', $request->serie_id)
            ->with(['lista.user' => function($e){
                $e->where('user_id', Auth::user()->id);
            }])
            ->delete();
    }

    //Alterar apenas o nome da lista
    public function nomeLista(Request $request)
    {
        $lista = $this->lista->find($request->lista_id);

        $lista->update($request->all());
    }
}
