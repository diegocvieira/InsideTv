<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emissora;
use Validator;
use File;

class EmissoraController extends Controller
{
    public function __construct(Emissora $emissora){
        $this->emissora = $emissora;
    }

    public function index()
    {
        $emissoras = $this->emissora->orderBy('nome', 'asc')->get();

        $title = "Emissoras - InsideTv";

        return view('admin.emissora-index', compact('emissoras', 'title'));
    }

    public function create()
    {
        $title = 'Cadastrar emissora - InsideTv';

        return view('admin.emissora-create-edit', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();

        $this->emissora->create($dataForm);

        $return['url'] = "/admin/emissora";

        return json_encode($return);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $emissora = $this->emissora->find($id);

        $title = 'Editar ' . $emissora->nome . ' - InsideTv';

        return view('admin.emissora-create-edit', compact('emissora', 'title'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();

        $this->emissora->find($id)->update($dataForm);

        $return['url'] = "/admin/emissora";

        return json_encode($return);
    }

    public function destroy($id)
    {
        $emissora = $this->emissora->find($id);

        $emissora->delete();

        $return['url'] = "/admin/emissora";

        return $return;
    }
}
