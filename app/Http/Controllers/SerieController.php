<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;
use App\Emissora;
use App\Genero;
use App\Sergen;
use App\ComentarioSerie;
use App\Avaliar;
use App\Lista;
use Agent;
use Auth;
use DB;
use App\ListasSerie;

class SerieController extends Controller
{
    public function __construct(Serie $serie){
        $this->serie = $serie;
    }

    public function index()
    {
        $series = $this->serie->orderBy('titulo_original', 'asc')->get();

        $title = "Séries - InsideTv";

        return view('admin.serie-index', compact('series', 'title'));
    }

    public function create()
    {
        $emissoras = Emissora::orderBy('nome', 'asc')->pluck('nome', 'id')->all();

        $generos = Genero::orderBy('nome', 'asc')->pluck('nome', 'id')->all();

        $status = [
            1 => 'Em andamento',
            0 => 'Em produção',
            2 => 'Completa',
            3 => 'Cancelada',
        ];

        $title = 'Cadastrar série - InsideTv';

        return view('admin.serie-create-edit', compact('title', 'emissoras', 'status', 'generos'));
    }

    public function store(Request $request)
    {
        $slug = str_slug($request->input('titulo_original'), '-');
        $request->request->add(['slug' => $slug]);

        $dataForm = $request->all();

        if($dataForm['data_lancamento'] != '')
            $dataForm['data_lancamento'] = SerieController::formataData($dataForm['data_lancamento']);

        $serie = $this->serie->create($dataForm);

        if($request->poster != ''){
            $ext = $request->poster->extension();

            $poster_nome = 'poster' . date('YmdHis') . '.' . $ext;

            $request->poster->move('images/series/' . $serie->id, $poster_nome);

            $this->serie->find($serie->id)->update(['poster' => $poster_nome]);
        }

        if($request->capa != ''){
            $ext = $request->capa->extension();

            $capa_nome = 'capa' . date('YmdHis') . '.' . $ext;

            $request->capa->move('images/series/' . $serie->id, $capa_nome);

            $this->serie->find($serie->id)->update(['capa' => $capa_nome]);
        }

        foreach($request->only('genero_id')['genero_id'] as $g){
            $serie->sergen()->create(['genero_id' => $g]);
        }

        $return['url'] = "/admin/serie";

        return json_encode($return);
    }

    public function show($slug)
    {
        $serie = $this->serie->where('slug', $slug);

        if(Auth::check()){
            //$serie = $serie->with(['lista.user' => function($q){
                //$q->where('user_id', Auth::user()->id);
            //}]);
            $serie = $serie->with('lista_serie.lista');

            $serie = $serie->with(['avaliacao' => function($e){
                $e->where('user_id', Auth::user()->id)
                    ->where('serie_id');
            }]);

            //Listar todas as listas do usuario logado
            $listas = Lista::where('user_id', Auth::user()->id)
                ->pluck('descricao', 'id')
                ->all();
        }

        $serie = $serie->first();

        //Nota geral
        $nota = Avaliar::select(DB::raw('ROUND((SUM(nota) / COUNT(id)), 1) as nota_final'))
            ->where('serie_id', $serie->id)
            ->first();

        $title = $serie->titulo_original . ' - InsideTv';

        return view('show-serie', compact('serie', 'title', 'nota', 'listas'));
    }

    public function edit($id)
    {
        $emissoras = Emissora::orderBy('nome', 'asc')->pluck('nome', 'id')->all();

        $generos = Genero::orderBy('nome', 'asc')->pluck('nome', 'id')->all();

        $sergens = Sergen::where('serie_id', $id)->get();

        //Armazena os generos da serie
        foreach($sergens as $sergen)
            $generos_select[] = $sergen->genero_id;

        $status = [
            1 => 'Em andamento',
            0 => 'Em produção',
            2 => 'Completa',
            3 => 'Cancelada',
        ];

        $serie = $this->serie->with('sergen')->find($id);

        if(isset($serie['data_lancamento'])){
            $data = explode("-", $serie['data_lancamento']);

            $ano = $data[0];
            $mes = $data[1];
            $dia = $data[2];

            switch($mes){
                case '01':
                    $mes = 'Janeiro';
                    break;
                case '02':
                    $mes = 'Fevereiro';
                    break;
                case '03':
                    $mes = 'Março';
                    break;
                case '04':
                    $mes = 'Abril';
                    break;
                case '05':
                    $mes = 'Maio';
                    break;
                case '06':
                    $mes = 'Junho';
                    break;
                case '07':
                    $mes = 'Julho';
                    break;
                case '08':
                    $mes = 'Agosto';
                    break;
                case '09':
                    $mes = 'Setembro';
                    break;
                case '10':
                    $mes = 'Outubro';
                    break;
                case '11':
                    $mes = 'Novembro';
                    break;
                case '12':
                    $mes = 'Dezembro';
                    break;
            }

            $serie['data_lancamento'] = $dia . ' ' . $mes . ', ' . $ano;
        }

        $title = 'Editar ' . $serie->titulo_original . ' - InsideTv';

        return view('admin.serie-create-edit', compact('serie', 'title', 'emissoras', 'generos', 'status', 'generos_select'));
    }

    public function update(Request $request, $id)
    {
        $slug = str_slug($request->input('titulo_original'), '-');
        $request->request->add(['slug' => $slug]);

        $dataForm = $request->all();

        $serie = $this->serie->find($id);

        if($dataForm['data_lancamento'] != '')
            $dataForm['data_lancamento'] = SerieController::formataData($dataForm['data_lancamento']);

        if($request->poster != ''){
            \File::delete('images/series/' . $serie->id . '/' . $serie->poster);

            $ext = $request->poster->extension();

            $poster_nome = 'poster' . date('YmdHis') . '.' . $ext;

            $request->poster->move('images/series/' . $serie->id, $poster_nome);

            $dataForm['poster'] = $poster_nome;
        }

        if($request->capa != ''){
            \File::delete('images/series/' . $serie->id . '/' . $serie->capa);

            $ext = $request->capa->extension();

            $capa_nome = 'capa' . date('YmdHis') . '.' . $ext;

            $request->capa->move('images/series/' . $serie->id, $capa_nome);

            $dataForm['capa'] = $capa_nome;
        }

        $serie->update($dataForm);

        $serie->sergen()->delete();

        foreach($request->only('genero_id')['genero_id'] as $g){
            $serie->sergen()->create(['genero_id' => $g]);
        }

        $return['url'] = "/admin/serie";

        return json_encode($return);
    }

    public function destroy($id)
    {
        $serie = $this->serie->find($id);

        if($serie->poster != '')
            \File::delete('images/series/' . $serie->id . '/' . $serie->poster);

        if($serie->capa != '')
            \File::delete('images/series/' . $serie->id . '/' . $serie->capa);

        if(($serie->poster || $serie->capa) != '')
            rmdir('images/series/' . $serie->id);

        $this->serie->find($id)->delete();

        $return['url'] = "/admin/serie";

        return $return;
    }

    public function formataData($dataForm){
        $data = explode(" ", $dataForm);

        $dia = $data[0];
        $ano = $data[2];
        $mes = str_replace(",", "", $data[1]);

        switch($mes){
            case 'Janeiro':
                $mes = '01';
                break;
            case 'Fevereiro':
                $mes = '02';
                break;
            case 'Março':
                $mes = '03';
                break;
            case 'Abril':
                $mes = '04';
                break;
            case 'Maio':
                $mes = '05';
                break;
            case 'Junho':
                $mes = '06';
                break;
            case 'Julho':
                $mes = '07';
                break;
            case 'Agosto':
                $mes = '08';
                break;
            case 'Setembro':
                $mes = '09';
                break;
            case 'Outubro':
                $mes = '10';
                break;
            case 'Novembro':
                $mes = '11';
                break;
            case 'Dezembro':
                $mes = '12';
                break;
        }

        return $ano . '-' . $mes . '-' . $dia;
    }
}
