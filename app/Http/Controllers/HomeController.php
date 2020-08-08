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
    public function index(Request $request)
    {
        $assunto = $request->assunto;
        $professor = $request->professor;
        $qtd = $request->qtd_questoes;
        $inst = $request->instituicao;

        if($this->objQuestao->where('assunto', $assunto)->count() >= $qtd){
            $questoes = $this->objQuestao->where('assunto', $assunto)->get()->random($qtd)->shuffle();
            $alternativas = $this->objQuestao;
            $pdf = PDF::loadView('gerador/prova', compact('assunto', 'inst', 'professor', 'questoes', 'alternativas'));
        $new =  $pdf->setPaper('a4')->stream('avaliacao.pdf');
        return $new;
        }else{
            $erro_qtd = true;
            return redirect()->back()->withInput()->withErrors(['Não há questões suficientes no banco.']);
        }

        
  

        
    }
}
