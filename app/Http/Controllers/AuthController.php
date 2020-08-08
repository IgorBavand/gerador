<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\ModelAssunto;



class AuthController extends Controller
{

    private $objAssunto;

        public function __construct(){
            $this->objAssunto = new ModelAssunto();
        }


    public function painel(){
        if(Auth::check() === true){
            $assunto=$this->objAssunto->all();
            return view('admin.painel', compact('assunto'));
        }else{
            return redirect()->route('admin.Formlogin');
        }
    }

    public function Formlogin(){
        return view('admin.Formlogin');
    }
    public function login(Request $req){
        //var_dump($req->all());
        $credenciais = [
            'email' => $req->email,
            'password' => $req->password,
        ];
        if(Auth::attempt($credenciais)){
            return redirect()->route('admin');
        }else{
            return redirect()->back()->withInput()->withErrors(['E-mail ou senha inválido(s)']);
        }
        
    }
    public function sair(){
        Auth::logout();
       // return redirect('home');
        return redirect()->route('admin');
    }
}
