<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Cookie;
use Exception;

class UserController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    public function cadastro(Request $request){
        $dataForm = $request->all();

        $dataForm['password'] = bcrypt($dataForm['password']);

        try{
            $cadastro = $this->user->create($dataForm);

            Auth::attempt(['email' => $dataForm['email'], 'password' => $request->input('password')]);

            $return['url'] = '/';
        }

        catch(Exception $e){
            $return['status'] = 'erro';
            $return['msg'] = 'E-mail já cadastrado no sistema';
        }

        return json_encode($return);
    }

    public function login(Request $request){
       if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember')))
           $return['url'] = '/';

       else{
           $return['msg'] =  'Informações inválidas';
           $return['status'] = 'erro';
       }

       return json_encode($return);
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
