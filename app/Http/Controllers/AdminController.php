<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    public function config(Request $request){
        if(password_verify($request->input('password_old'), Auth::user()->password)){
            $dataForm = $request->all();

            $dataForm['password'] = bcrypt($dataForm['password']);

            $this->user->find(Auth::user()->id)->update($dataForm);

            $return['url'] = 'config';
        }

        else{
            $return['msg'] = 'Senha atual invalida';
            $return['status'] = 'erro';
        }

        return json_encode($return);
    }
}
