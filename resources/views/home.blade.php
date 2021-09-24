@extends('layouts.app')
<!--
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
-->

@section('content')

<section class="set-icone-home">

            <div class="set-icone-home">
                <h1>teste</h1>
            </div>
    
            <div class="hero-text text-white">
                <div class="container border">
                    <h2>Bem-Vindo ao gerador de avaliações</h2>
                    <p>Sistema desenvolvido para auxiliar no ensino, gerando avaliações instantaneas</p>
                </div>

                <a data-target="#gerar_prova" data-toggle="modal" class="btn btn-primary" >Gerar Avaliação</a>
                <a data-target="#cad_questao" data-toggle="modal" class="btn btn-primary" >Cadastrar Questões</a>
                <a class="btn btn-warning" style="color: black;">Minhas Questões</a>
            </div>

        </section>

<div class="modal fade" id="gerar_prova" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="txtGerar">Gerar Avaliação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome da Instituição:</label>
                            <input type="text" class="form-control" id="instituicao" name="instituicao">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome do Professor:</label>
                            <input type="text" class="form-control" id="professor" name="professor">
                        </div>

                        <div class="form-group">
                            <label for="disciplina">Disciplina</label>
                            <select class="form-control" id="disciplina">
                                <option>matemática</option>
                                <option>portugues</option>
                                <option>geografia</option>
                                <option>história</option>
                                <option>biologia</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assunto">Assunto</label>
                            <select class="form-control" id="assunto">
                                <option>raiz quadrada</option>
                                <option>adição</option>
                                <option>subtração</option>
                                <option>divisão</option>
                                <option>multiplicação</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="qtd_questoes">Quantidade de Questões</label>
                            <select class="form-control" id="qtd_questoes">
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>

                            </select>
                        </div>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success">Gerar Avaliação</button>
                </div>
            </div>
        </div>
    </div>







    <div class="modal fade" id="cad_questao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <textarea  class="form-control" id="enunciado" rows="2" name="texto"></textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="alt1" class="col-form-label">Alternativa 01:</label>
                        
                            <input type="text" class="form-control" id="alt1" name="alt1">
                        </div>

                        <div class="form-group">
                            <label for="alt2" class="col-form-label">Alternativa 02:</label>
                            <input type="text" class="form-control" id="alt2" name="alt2">
                        </div>



                        <div class="form-group">
                            <label for="alt3" class="col-form-label">Alternativa 03:</label>
                            <input type="text" class="form-control" id="alt3" name="alt3">
                        </div>

                        <div class="form-group">
                            <label for="alt4" class="col-form-label">Alternativa 04:</label>
                            <input type="text" class="form-control" id="alt4" name="alt4">
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




