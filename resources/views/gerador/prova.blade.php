<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
    body {
        background: white;
        font-family: DejaVu Sans;

    }

    .cab-titulo {
        color: black;
        font-size: 30px;
        padding: 25px;
        display: flex;

    }

    .nota {
        float: right: width: 25%;
    }

    .place-nota {
        width: 50%;


    }

    .cabecalho {
        padding: 10px;
        margin-top: 2%;

    }

    .questao {
        padding: 10px;
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
        font-size: 20px;
    }

    .letras-quest {
        font-size: 20px;
    }

    .inst {
        font-size: 25px;
        font-weight: italic;


    }

    .cont-tit {
        text-align: center;
        height: 5%;
    }
    </style>
</head>

<body>
    @php
    use App\Models\ModelQuestao;
    use App\Models\ModelAlternativas;
    @endphp

    <div class="cont-tit ">
        <h2 class="cab-titulo">Avaliação de @php echo $assunto; @endphp </h2>
    </div>
    <div class="cont-tit ">
        <h2 class="inst">@php echo $inst; @endphp </h2>
    </div>


    <div class="border cabecalho">

        <div class="border">
            <h5 class="professor esp-esq letras-cab">Professor: @php echo $professor; @endphp</h5>
            <h5 class="esp-esq letras-cab">Data:___/___/___ &nbsp;&nbsp;&nbsp;&nbsp; Nota:________</h5>
        </div>

        <div class="">
            <h5 class="esp-esq letras-cab">Aluno:____________________________________________________________</h5>


        </div>


    </div>
    <div class="ml-5 mt-5">

        @php
        $num_questao = 0;
        $veri_alt = 0;

        @endphp
        @foreach($questoes as $questao)
        @php
        $select_de_alt = $alternativas->find($questao->id)->relAlt->shuffle();
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

        <p class="letras-quest"> @php echo $letra @endphp {{$sel->alternativa}}</p>



        @endforeach

        @endforeach




    </div>


</body>

</html>