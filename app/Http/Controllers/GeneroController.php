<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use Validator;

class GeneroController extends Controller
{
     public function __construct(Genero $genero){
         $this->genero = $genero;
     }

     public function teste(Request $request){
         $offset1 = $request->get('page');

         $offset = $offset1 + 1;

         $generos = $this->genero->orderBy('nome', 'asc')->limit(2)->offset($offset)->get();



         return view('teste', compact('generos', 'offset'));
     }

    public function index()
    {
        $generos = $this->genero->orderBy('nome', 'asc', 'offset')->get();

        $title = "Gêneros - InsideTv";

        return view('admin.genero-index', compact('generos', 'title'));
    }

    public function create()
    {
        $title = 'Cadastrar gênero - InsideTv';

        return view('admin.genero-create-edit', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();

        $this->genero->create($dataForm);

        $return['url'] = "/admin/genero";

        return json_encode($return);
    }

    public function edit($id)
    {
        $genero = $this->genero->find($id);

        $title = 'Editar ' . $genero->nome . ' - InsideTv';

        return view('admin.genero-create-edit', compact('genero', 'title'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();

        $this->genero->find($id)->update($dataForm);

        $return['url'] = "/admin/genero";

        return json_encode($return);
    }

    public function destroy($id)
    {
        $this->genero->find($id)->delete();

        $return['url'] = "/admin/genero";

        return $return;
    }
}
