<?php

namespace App\Http\Controllers;
//require_once 'vendor.dompdf.autoload.inc.php';
use Illuminate\Http\Request;
use App\Models\ModelQuestao;
use App\Models\ModelAlternativas;
use App\Models\ModelAssunto;
use App\Models\ModelSubjetiva;
use Illuminate\Support\Facades\Auth;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function __construct()
    {
        $this->objQuestao = new ModelQuestao();
        $this->objAlternativas = new ModelAlternativas();
        $this->objAssunto = new ModelAssunto();
        $this->objSubjetiva = new ModelSubjetiva();
    }



    //falta implementar

    public function formUpdate($id){
        $nome = Auth::user()->name;
        $email = Auth::user()->email;
        return redirect('/register');

    }

    public function formCadastroQuestao(){

        if(Auth::check() === true){
            $assunto = ModelAssunto::all();
            return view('admin.formCadastroQuestao', compact('assunto'));
        }

        return redirect()->back()->with('error', 'Você presica estar conectado!');

        
    }



    public function rotaGerarPost(Request $request){

    

        if(Auth::check() === true){
try{
            $assunto = $request->assunto;
            $professor = $request->professor;
            $qtd = $request->qtd_questoes;
            $inst = $request->instituicao;

           $rand1 = rand(1000, 9999);
            $rand2 = rand(0,9);


            //gera um codigo para a prova
            $codigo = $rand1.$rand2;


        if ($this->objQuestao->where('assunto', $assunto)->count() >= $qtd) {
            $questoes = $this->objQuestao->where('assunto', $assunto)->get()->random($qtd)->shuffle();
            
            
            //$questoes = $this->objQuestao->where('assunto', $assunto)->get()->inRandomOrder()->shuffle();

            $alternativas = $this->objQuestao;
            $subjetivas = $this->objSubjetiva;
         


            //passando valores para sessoes e para recuperá-los depois
            session()->put('questoes', $questoes);
            session()->put('alternativas', $alternativas);
            session()->put('assunto', $assunto);
            session()->put('professor', $professor);
            session()->put('inst', $inst);
            session()->put('subjetivas', $subjetivas);
            session()->put('codigo', $codigo);

            return view('admin.painelOpcoes');
        } else {
            $erro_qtd = true;
            return redirect()->back()->withInput()->withErrors(['Não há questões suficientes no banco.']);
        }

        }catch(Exception $ex){
            return "Erro, tente novamente.";
        }


        
        }

        return redirect()->back()->with('error', 'Você presica estar conectado!');

    }


    public function rotaGerarGet(){


            if(Auth::check() === true){
                try{
                    

            return view('admin.painelOpcoes');

                }catch(Exception $ex){
                        return "Erro, tente novamente.";
                }
            }
    }
    


    public function gerarAvaliacao(Request $request)
    {
        if(Auth::check() === true){
             if ($request->isMethod('post')) {    
            return $this->rotaGerarPost($request);
            }else if($request->isMethod('get')){
                return $this->rotaGerarGet($request);
            }  

        }else{
        return redirect()->back()->with('error', 'Você presica estar conectado!');
        }
                
    }

    

    public function download_gabarito()
    {

        if(Auth::check() === true){
        $assunto = session()->get('assunto');
        $inst = session()->get('inst');
        $alternativas = session()->get('alternativas');
        $questoes = session()->get('questoes');
        $professor = session()->get('professor');
        $subjetivas = session()->get('subjetivas');
        $codigo = session()->get('codigo');

        /* session()->flush('assunto');
        session()->flush('inst');
        session()->flush('questoes');
        session()->flush('alternativas');
        session()->flush('professor');
        */
        $pdf = PDF::loadView('gerador/gabarito', compact('assunto', 'inst', 'professor', 'questoes', 'alternativas', 'subjetivas', 'codigo'));
        $new =  $pdf->setPaper('a4')->download('gabarito.pdf');
        return $new;
        }

        return redirect()->back()->with('error', 'Você presica estar conectado!');
        
    }


    public function minhas_questoes($id){
        if(Auth::check() === true){
            if(Auth::user()->id == $id){
                $minhas_questoes = ModelQuestao::where('id_user', $id)->get();
            return view('admin.minhasQuestoes', compact('minhas_questoes'));

            }else{
                return redirect()->back()->with('error', 'Você só tem acesso as suas questões!');

            }
             
        }else{
            return redirect()->back()->with('error', 'Você presica estar conectado!');

        }
       
    }

    public function visualizar_questao($id_usuario, $id_questao){

        if(Auth::check() === true){

           $questao = ModelQuestao::find($id_questao);
           $assunto = ModelAssunto::all();

           if(isset($questao)){

            if($questao->id_user == $id_usuario){
                return view('admin.formCadastroQuestao', compact('assunto', 'questao'));
            }else{
                return 'aqui fora';
            }

           }else{
                return redirect()->route("localhost:8000")->with('error', 'Você presica estar conectado!');


           }


        }else{
            return redirect()->back()->with('error', 'Você presica estar conectado!');

        }
        
    }

    public function download_prova()
    {


        if(Auth::check() === true){

        $assunto = session()->get('assunto');
        $inst = session()->get('inst');
        $alternativas = session()->get('alternativas');
        $questoes = session()->get('questoes');
        $professor = session()->get('professor');
        $codigo = session()->get('codigo');

        /* session()->flush('assunto');
        session()->flush('inst');
        session()->flush('questoes');
        session()->flush('alternativas');
        session()->flush('professor');
        */
        $pdf = PDF::loadView('gerador/prova', compact('assunto', 'inst', 'professor', 'questoes', 'alternativas', 'codigo'));
        $new =  $pdf->setPaper('a4')->download('prova.pdf');
        return $new;

        }

        return redirect()->back()->with('error', 'Você presica estar conectado!');

    }


    public function edit_sub(Request $request, $id_quest, $id_sub){
        $this->objQuestao->where(['id'=>$id_quest])->update([
             'id_user'=>Auth::user()->id,
            'assunto'=>$request->assunto,
            'texto'=>$request->texto,
        ]);

        $this->objSubjetiva->where('id', $id_sub)->update([
               
                'resposta' => $request->subjetiva
            ]);


            return redirect('/')->with('message', 'A questão foi alterada com sucesso!');

        
        
    }


    public function edit_alt(Request $request, $id_quest, $id1, $id2, $id3, $id4){

$this->objQuestao->where(['id'=>$id_quest])->update([
             'id_user'=>Auth::user()->id,
            'assunto'=>$request->assunto,
            'texto'=>$request->texto,
        ]);


        if((isset($request->alt1)) && (isset($request->alt2)) && (isset($request->alt3)) && (isset($request->alt4))){
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
             
             $this->objAlternativas->where(['id'=>$id1])->update([
                 
                 'alternativa'=>$request->alt1,
                 'check'=>$ck1,
                  
             ]);
     
             $this->objAlternativas->where(['id'=>$id2])->update([
                 
                 'alternativa'=>$request->alt2,
                 'check'=>$ck2,
                  
             ]);
     
             $this->objAlternativas->where(['id'=>$id3])->update([
                 
                 'alternativa'=>$request->alt3,
                 'check'=>$ck3,
                  
             ]);
     
             $this->objAlternativas->where(['id'=>$id4])->update([
                 
                 'alternativa'=>$request->alt4,
                 'check'=>$ck4,
                  
             ]);
            }
        
                        return redirect('/')->with('message', 'A questão foi alterada com sucesso!');


    }

}

