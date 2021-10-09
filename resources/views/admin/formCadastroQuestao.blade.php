@extends('layouts.app')

@section('content')



<div class="container text-light font-weight-bold text-uppercase">

    @if(!isset($questao))
    <h3 id="txtCadastrar" class="text-light">Cadastrar Questão</h3>
    @else 
        <h3 id="txtCadastrar" class="text-light">Editar Questão</h3>
@endif


    <div class="center">
        <label for="checkbox_questao" class="mt-5">Alterne para questão subjetiva</label>
        <input class="mt-25" type="checkbox" name="checkbox_questao" id="checkbox_questao">
    </div>



            @php 
                use App\Models\ModelAlternativas;
                use App\Models\ModelSubjetiva;


            if(isset($questao)){

                $subjetiva = ModelSubjetiva::where('id_questao', $questao->id)->first();

                
                $alt1 = ModelAlternativas::where('id_questao', $questao->id)->first();
               

                if(isset($alt1)){

                $certa = '';

                
                $id2 = ($alt1->id)+1;

                
                $alt2 = ModelAlternativas::find($id2);
                $id3 = ($alt2->id)+1;

                $alt3 = ModelAlternativas::find($id3);
                $id4 = ($alt3->id)+1;

                $alt4 = ModelAlternativas::find($id4);

                if($alt1->check == 'c') $certa = '1';
                if($alt2->check == 'c') $certa = '2';
                if($alt3->check == 'c') $certa = '3';
                if($alt4->check == 'c') $certa = '4';


                

                }
                
            }
            @endphp

    @if(isset($questao) && isset($alt1))
        <form name="cad_questao" action="{{url("edit-alt/$questao->id/$alt1->id/$id2/$id3/$id4")}}" method="post">

        @method('put')
    @endif
    @if(isset($questao) && isset($subjetiva))
        <form name="cad_questao" action="{{url("edit-sub/$questao->id/$subjetiva->id")}}" method="post">

        @method('put')
    @endif
        @if(!isset($questao))
        <form name="cad_questao" action="{{url('questao')}}" method="post">

    @endif
    
    @csrf
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Enunciado da Questão:</label>
            <textarea class="form-control" id="enunciado" rows="2" name="texto" required>{{ $questao->texto  ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="ass">Selecione o assunto da questao:</label>
            <select class="form-control" id="ass" name="assunto">
                <option>{{$questao->assunto ?? ''}}</option>
                @foreach($assunto as $assuntos)
                <option>{{$assuntos->assunto}}</option>
                @endforeach

            </select>
        </div>


        <div id="div-subjetiva">
            <div class="form-group">
                <label for="sujetiva" class="col-form-label">Resposta:</label>
                <textarea type="text" class="form-control" id="subjetiva"  name="subjetiva">{{ $subjetiva->resposta ?? ' ' }}</textarea>
            </div>

        </div>


        <div id="div-alternativas">
           

        
           

            <div class="form-group">
                <label for="alt1" class="col-form-label">Alternativa 01:</label>

                <input type="text" class="form-control" id="alt1" name="alt1" value="{{ $alt1->alternativa ?? ' ' }}">
            </div>

            <div class="form-group">
                <label for="alt2" class="col-form-label">Alternativa 02:</label>
                <input type="text" class="form-control" id="alt2" name="alt2" value="{{ $alt2->alternativa ?? ' ' }}">
            </div>



            <div class="form-group">
                <label for="alt3" class="col-form-label">Alternativa 03:</label>
                <input type="text" class="form-control" id="alt3" name="alt3" value="{{ $alt3->alternativa ?? ' ' }}">
            </div>

            <div class="form-group">
                <label for="alt4" class="col-form-label">Alternativa 04:</label>
                <input type="text" class="form-control" id="alt4" name="alt4" value="{{ $alt4->alternativa ?? ' ' }}">
            </div>

            <!-- CHECKBOX PARA MARCAR ALTERNATIVA CORRETA -->
            <div class="form-group">
                <label for="exampleFormControlSelect1">Selecione a alternativa correta:</label>
                
                <select class="form-control" id="exampleFormControlSelect1" name="check">
                    <option selected>{{ $certa ?? '' }}</option>
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

            @if(isset($questao))
            <input type="submit" class="btn btn-success" value="Editar">
            @else 
            <input type="submit" class="btn btn-success" value="Cadastrar">
            @endif

        </div>
    </form>

    <input type="hidden" name="" id="verifica" value="{{ $subjetiva->resposta ?? '' }}">

</div>


<script>
$(document).ready(() => {
    $("#div-subjetiva").hide();
    if($("#verifica").val() != ""){
        $("#checkbox_questao").prop( "checked", true );
                $("#div-alternativas").hide();

        $("#div-subjetiva").show();
    }
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