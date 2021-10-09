@extends('layouts.app')

@section('content')

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

<style>

p{
    font-size: 14px;
}


.div-mq{
    padding: 2%;
    margin: 2%;
}
.div-titulo{
    margin: 1%;
}
</style>


<div class="container">

<div class="row d-flex justify-content-center div-titulo">
        <h4 class="text-light">Questões de {{ Auth::user()->name }}</h4>
    </div>
    

    @foreach($minhas_questoes as $res)

    <div class="container div-mq border rounded">

    <p class="text-light minhas-questoes"> {{$res->texto}}</p>

    <a href="/visualizar/minhas/questoes/{{Auth::user()->id}}/{{$res->id}}" class="btn btn-sm botoes text-light">Visualizar Questão</a>

    </div>

    
       
    @endforeach
</div>
@endsection