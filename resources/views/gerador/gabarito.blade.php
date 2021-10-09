<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
  body { font-family: DejaVu Sans, sans-serif; }
</style>
    <title>Document</title>


     <style>
  

    .cab-titulo {
        color: black;
        font-size: 14px;
        display: flex;

    }

    .nota {
        float: right: width: 25%;
    }

    .place-nota {
        width: 50%;
    }

    .cabecalho {
        padding: 0;
        margin-top: -10px;

    }

    .questao {
        padding: 0;
    }

    .pagina {
        width: 500px;
    }

    .border {
        border-width: medium;
        border-style: solid;
    }

    .esp-esq {
        margin-left: 2%;
    }

    .letras-cab {
        font-size: 13px;
        margin-top: 1px;
    }

    .letras-quest {
        font-size: 12px;
        font-weight: bold;

    }
    .letras-alt {
        font-size: 12px;
        

    }

    .inst {
        font-size: 14px;
        font-weight: italic;
        margin-top: -14px;


    }

    .cont-tit {
        text-align: center;

    }

    .aluno {
        margin-top: -10px;
    }

    .data {
        margin-top: -10px;
    }
    </style>
</head>

<body>
    @php
    use App\Models\ModelQuestao;
    use App\Models\ModelAlternativas;
    use App\Models\ModelSubjetiva;

    

    @endphp

    <div class="cont-tit ">
        <h2 class="cab-titulo">Gabarito Avaliação de @php echo $assunto; @endphp - {{$codigo}} </h2>
    </div>
    <div class="cont-tit ">
        <h2 class="inst">@php echo $inst; @endphp </h2>
    </div>


    <div class="cabecalho">

            <h5 class="professor esp-esq letras-cab">Professor: @php echo $professor; @endphp</h5>
    


    </div>
    <div class="ml-5 mt-5">

        @php
        $num_questao = 0;
        $veri_alt = 0;

        @endphp
        @foreach($questoes as $questao)
        @php
        $select_de_alt = $alternativas->find($questao->id)->relAlt->shuffle();
        $resposta = $subjetivas->where('id_questao', $questao->id)->get();
        @endphp
        <p class="letras-quest">@php $num_questao++; echo $num_questao . " )"; @endphp {{$questao->texto}}</p>
        @php $veri_alt = 0; @endphp
        @foreach($select_de_alt as $sel)
        @php


        $veri_alt++;
        switch($veri_alt){
        case 1:
        $letra = 'A )';
        break;
        case 2:
        $letra = 'B )';
        break;
        case 3:
        $letra = 'C )';
        break;
        case 4:
        $letra = 'D )';
        break;
        }


        @endphp
        @if($sel->check === 'c')
        <p style="color:green; font-weight: bold;" class="letras-quest"> @php echo $letra @endphp {{$sel->alternativa}}
        </p>
        @else
        <p class="letras-quest"> @php echo $letra @endphp {{$sel->alternativa}}</p>
        @endif





        @endforeach


        @foreach($resposta as $res)

        <p style="color:green; font-weight: bold;" class="letras-quest">{{ $res->resposta }}</p>

        @endforeach



        @endforeach




    </div>


</body>

</html>