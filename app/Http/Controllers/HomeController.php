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

    public function formCadastroQuestao(){

        if(Auth::check() === true){
            $assunto = ModelAssunto::all();
            return view('admin.formCadastroQuestao', compact('assunto'));
        }

        return redirect('/');

        
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

        return redirect('/');

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
            return redirect('/');
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

        return redirect('/');
        
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

        return redirect('/');

    }
}