@extends('layouts.app')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>

body{
    background: #eee;
}
span{
    font-size:15px;
}
a{
  text-decoration:none; 
  color: #0062cc;
  border-bottom:2px solid #0062cc;
}
.box{
    padding:60px 0px;
}

.box-part{
    background:#FFF;
    border-radius:0;
    padding:60px 10px;
    margin:30px 0px;
}
.text{
    margin:20px 0px;
}

.fa{
     color:#4183D7;
}

.titulo-pag{
    background-color: white;
}
</style>



<div class="box">
    <div class="container">
        
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h3 class="display-4 fst-italic">Valeu por usar o GERPRO!</h3>
    </div>

    <div class="row">
            
			 
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-file fa-3x" aria-hidden="true"></i>
                        
						<div class="title">
							<h4>Baixar Avaliação</h4>
						</div>
                        
						<div class="text text-black">
							<span>Clique no botão abaixo para baixar a avaliação.</span>
						</div>
                        
						<a href="#" class="btn btn-primary">Download</a>
                        
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
					    
					    <i class="fa fa-file-text fa-3x" aria-hidden="true"></i>
                    
						<div class="title">
							<h4>Baixar Gabarito</h4>
						</div>
                        
						<div class="text">
							<span>CLique no botão abaixo para baixar o gabarito da avalição.</span>
						</div>
                        
						<a href="#" class="btn btn-primary">Download</a>
                        
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-plus     fa-3x" aria-hidden="true"></i>
                        
						<div class="title">
							<h4 class="">Facebook</h4>
						</div>
                        
						<div class="text">
							<span>Clique no botão abaixo para baixar a avaliação.</span>
						</div>
                        
						<a href="#" class="btn btn-primary">Ir para apágina</a>
                        
					 </div>
				</div>	 
				
					 
				
				
				</div>	 
				</div>
  </div>
     	
		
		</div>		
    </div>
</div>
@endsection