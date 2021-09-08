<!DOCTYPE html>
<html lang="pt-br">
    <meta charser="utf-8">
    <head>

        <!-- Stylesheets -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}"/>
        <link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}"/>
        <link rel="stylesheet" href="{{url('assets/css/index.css')}}"/>
    <title>Gerador</title>
    </head>
    <body>
   
    @yield('content')
    @yield('loginview')
        
    </body>







    <!--====== Javascripts & Jquery ======-->
    <script src="{{url('assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/mixitup.min.js')}}"></script>
    <script src="{{url('assets/js/circle-progress.min.js')}}"></script>
    <script src="{{url('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('asstes/js/main.js')}}"></script>
    
</html>