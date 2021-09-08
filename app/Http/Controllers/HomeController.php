<?php

namespace App\Http\Controllers;
//require_once 'vendor.dompdf.autoload.inc.php';
use Illuminate\Http\Request;
use App\Models\ModelQuestao;
use App\Models\ModelAlternativas;
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

    public function __construct(){
        $this->objQuestao = new ModelQuestao();
        $this->objAlternativas = new ModelAlternativas();
    }
    public function gerarAvaliacao(Request $request)
    {
        $assunto = $request->assunto;
        $professor = $request->professor;
        $qtd = $request->qtd_questoes;
        $inst = $request->instituicao;

        if($this->objQuestao->where('assunto', $assunto)->count() >= $qtd){
            $questoes = $this->objQuestao->where('assunto', $assunto)->get()->random($qtd)->shuffle();
            $alternativas = $this->objQuestao;
         //   $pdf = PDF::loadView('gerador/prova', compact('assunto', 'inst', 'professor', 'questoes', 'alternativas'));
        //$new =  $pdf->setPaper('a4')->stream('avaliacao.pdf');

        
        //passando valores para sessoes e para recuperá-los depois
        session()->put('questoes', $questoes);
        session()->put('alternativas', $alternativas);
        session()->put('assunto', $assunto);
        session()->put('professor', $professor);
        session()->put('inst', $inst);    

        return view('admin.painelOpcoes');
       
    
    }else{
            $erro_qtd = true;
            return redirect()->back()->withInput()->withErrors(['Não há questões suficientes no banco.']);
        }
        
    }

    public function download_gabarito(){

        $assunto = session()->get('assunto');
        $inst = session()->get('inst');
        $alternativas = session()->get('alternativas');
        $questoes = session()->get('questoes');
        $professor = session()->get('professor');
       
       /* session()->flush('assunto');
        session()->flush('inst');
        session()->flush('questoes');
        session()->flush('alternativas');
        session()->flush('professor');
        */
        $pdf = PDF::loadView('gerador/gabarito', compact('assunto', 'inst', 'professor', 'questoes', 'alternativas'));
        $new =  $pdf->setPaper('a4')->download('gabarito.pdf');
        return $new;

    }

    public function download_prova(){

        $assunto = session()->get('assunto');
        $inst = session()->get('inst');
        $alternativas = session()->get('alternativas');
        $questoes = session()->get('questoes');
        $professor = session()->get('professor');
       
       /* session()->flush('assunto');
        session()->flush('inst');
        session()->flush('questoes');
        session()->flush('alternativas');
        session()->flush('professor');
        */
        $pdf = PDF::loadView('gerador/prova', compact('assunto', 'inst', 'professor', 'questoes', 'alternativas'));
        $new =  $pdf->setPaper('a4')->download('prova.pdf');
        return $new;

    }
}
