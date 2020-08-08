<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelQuestao;
use App\Models\ModelAlternativas;
use Illuminate\Support\Facades\Auth;
class SysController extends Controller
{
    private $objQuestao;
    private $objAlternativas;



    public function __construct(){
        $this->objQuestao = new ModelQuestao();
        $this->objAlternativas = new ModelAlternativas();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('index');
     // dd($this->objQuestao->all());
    }
    public function login()
    {
        
      //return view('admin.login');
     
    }
    public function home()
    {
      return view('home');
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //  $cb1 = string($request->alt1);

        
       if($request->check == '1'){
           $ck1 = 'c';
       }else{
        $ck1 = 'e';
       } 

       if($request->check == '2'){
            $ck2 = 'c';
        }else{
            $ck2 = 'e';
        }  
        if($request->check == '3'){
            $ck3 = 'c';
        }else{
         $ck3 = 'e';
        }  
        if($request->check == '4'){
            $ck4 = 'c';
        }else{
         $ck4 = 'e';
        }  
            
        $questoes = $this->objQuestao->create([
            'id_user'=>1,
            'assunto'=>$request->assunto,
            'texto'=>$request->texto,
             
        ]);

      $lastId = $questoes->id;

        
        $this->objAlternativas->create([
            'id_questao'=>$lastId,
            'alternativa'=>$request->alt1,
            'check'=>$ck1,
             
        ]);

        $this->objAlternativas->create([
            'id_questao'=>$lastId,
            'alternativa'=>$request->alt2,
            'check'=>$ck2,
             
        ]);

        $this->objAlternativas->create([
            'id_questao'=>$lastId,
            'alternativa'=>$request->alt3,
            'check'=>$ck3,
             
        ]);

        $this->objAlternativas->create([
            'id_questao'=>$lastId,
            'alternativa'=>$request->alt4,
            'check'=>$ck4,
             
        ]);
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
