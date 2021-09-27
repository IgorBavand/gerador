@extends('layouts.app')

@section('content')
<!--
<style>
    .set-fundo {
	background-repeat: no-repeat;
	background-size: cover;
	background-position: top center;
    background-image: url("{{url('assets/img/fundo.jpg')}}");
    
}
-->
<style>
.ajuste-card {
    margin-top: 5%;
}

.container-card {
    background-color: #6C7A86;
}
</style>
<div class="container ajuste-card">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card container-card">
                <div class="card-header text-light text-uppercase font-weight-bold">{{ __('Login') }}</div>


                <div class="card-body">
                    <div class="mb-4 row d-flex justify-content-center">
                        <img class="ml-10 comp" src="{{url('assets/img/ICONE.png')}}" alt="logo GERPRO"
                            style="heigth: 100%; width: 30%;">
                    </div>

                    @if($errors->all())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                    @endif
                    <form method="POST" action="{{ route('admin.login.do') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right text-light font-weight-bold">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right text-light font-weight-bold">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-light" for="remember">
                                        {{ __('Lembrar') }}
                                    </label>
                                    <a href="#"></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Entrar') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection