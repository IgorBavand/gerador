@extends('layouts.app')

@section('content')

<section class="hero-section" style="mt-0">

<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>




    @if($errors->all())
    @foreach($errors->all() as $error)
    <div class="alert alert-warning">{{$error}}</div>
    @endforeach
    @endif
    <div class="hero-text text-white div-pai">

        <div class="container">
            <div class="set-icone-home">
                <img class="icone-home" src="{{url('assets/img/logoGERPRO.png')}}" alt="icone">
            </div>
            <div class="mt-4">
                <h2 class="letra-home">Bem-Vindo ao gerador de avaliações</h2>

                <p>Sistema desenvolvido para auxiliar no ensino, gerando avaliações instantaneas</p>

            </div>
        </div>

        <a data-target="#gerar_prova" data-toggle="modal" class="btn botoes mt-2">Gerar Avaliação</a>
        <a href="formCadastrarQuestao" class="btn botoes mt-2">Cadastrar Questões</a>
        
        <div class="row justify-content-center align-items-center mt-2">
                    <a class="btn botoes" href="visualizar/minhas/questoes/{{Auth::user()->id}}">Minhas Questões</a>


        </div>
                
    </div>

</section>




<div class="modal fade" id="gerar_prova" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="txtGerar">Gerar Avaliação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="gerar_prova" action="{{url('gerar')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome da Instituição:</label>
                        <input type="text" class="form-control" id="instituicao" name="instituicao" value="" required
                            maxlength="191">
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome do Professor:</label>
                        <input type="text" class="form-control" id="professor" name="professor"
                            value="{{Auth::user()->name}}" required maxlength="191">
                    </div>



                    <div class="form-group">
                        <label for="assunto">Assunto</label>
                        <select class="form-control" id="assunto" name="assunto">
                            @foreach($assunto as $assuntos)
                            <option>{{$assuntos->assunto}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="qtd_questoes">Quantidade de Questões</label>
                        <select class="form-control" id="qtd_questoes" name="qtd_questoes">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>

                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Gerar Avaliação</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>







<div class="modal fade" id="cad_questao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="txtCadastrar">Cadastrar Questão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="cad_questao" action="{{url('questao')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Enunciado da Questão:</label>
                        <textarea class="form-control" id="enunciado" rows="2" name="texto" maxlength="191"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ass">Selecione o assunto da questao:</label>
                        <select class="form-control" id="ass" name="assunto">
                            @foreach($assunto as $assuntos)
                            <option>{{$assuntos->assunto}}</option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="alt1" class="col-form-label">Alternativa 01:</label>

                        <input type="text" class="form-control" id="alt1" name="alt1" maxlength="191" required>
                    </div>

                    <div class="form-group">
                        <label for="alt2" class="col-form-label">Alternativa 02:</label>
                        <input type="text" class="form-control" id="alt2" name="alt2" maxlength="191" required>
                    </div>



                    <div class="form-group">
                        <label for="alt3" class="col-form-label">Alternativa 03:</label>
                        <input type="text" class="form-control" id="alt3" name="alt3" maxlength="191" required>
                    </div>

                    <div class="form-group">
                        <label for="alt4" class="col-form-label">Alternativa 04:</label>
                        <input type="text" class="form-control" id="alt4" name="alt4" maxlength="191" required>
                    </div>

                    <!-- CHECKBOX PARA MARCAR ALTERNATIVA CORRETA -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Selecione a alternativa correta:</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="check">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <!-------------------------------------------------->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                        <input type="submit" class="btn btn-success" value="Cadastrar">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection