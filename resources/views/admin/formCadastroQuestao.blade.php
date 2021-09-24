@extends('layouts.app')

@section('content')



<div class="container text-light font-weight-bold text-uppercase">

    <h3 id="txtCadastrar" class="text-light">Cadastrar Questão</h3>


    <div class="center">
        <label for="checkbox_questao" class="">Alterne para questão subjetiva</label>
        <input class="mt-25" type="checkbox" name="" id="checkbox_questao">
    </div>





    <form name="cad_questao" action="{{url('questao')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Enunciado da Questão:</label>
            <textarea class="form-control" id="enunciado" rows="2" name="texto" required></textarea>
        </div>

        <div class="form-group">
            <label for="ass">Selecione o assunto da questao:</label>
            <select class="form-control" id="ass" name="assunto">
                @foreach($assunto as $assuntos)
                <option>{{$assuntos->assunto}}</option>
                @endforeach

            </select>
        </div>


        <div id="div-subjetiva">
            <div class="form-group">
                <label for="sujetiva" class="col-form-label">Resposta:</label>
                <textarea type="text" class="form-control" id="subjetiva" name="subjetiva"></textarea>
            </div>

        </div>


        <div id="div-alternativas">

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

        </div>

        <!-------------------------------------------------->

        <div class="modal-footer">
            <button onclick="window.location.href='/'" type="button" href="/" class="btn btn-danger">Cancelar</button>

            <input type="submit" class="btn btn-success" value="Cadastrar">

        </div>
    </form>

</div>


<script>
$(document).ready(() => {
    $("#div-subjetiva").hide();
});

$("#checkbox_questao").on("click", () => {
    if ($("#checkbox_questao").is(":checked")) {
        $("#div-alternativas").hide();
        $("#div-subjetiva").show();

        //valor vazio para os campos de alternativas

        $("#alt1").val("");
        $("#alt2").val("");
        $("#alt3").val("");
        $("#alt4").val("");

        //$("#alt1").attr("required", this.value == 'req');
    } else {
        $("#div-subjetiva").hide();
        $("#div-alternativas").show();

        //valor vazio no campo de subjtiva

        $("#subjetiva").val("");
        //  $("#alt1").removeAttr("required");
    }
});
</script>





@endsection