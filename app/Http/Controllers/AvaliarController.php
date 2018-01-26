<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avaliar;
use Auth;

class AvaliarController extends Controller
{
    public function __construct(Avaliar $avaliar){
        $this->avaliar = $avaliar;
    }

    public function store(Request $request){
        $dataForm = $request->all();

        Avaliar::where('serie_id', $dataForm['serie_id'])
            ->where('user_id', $dataForm['user_id'])
            ->delete();

        $this->avaliar->create($dataForm);

        return json_encode(true);
    }
}
