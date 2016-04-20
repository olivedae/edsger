@extends('layouts.app')

@section('title', 'Register')

@section('content')

<section id="register-container" class="container login-register-top-buffer">
    <div class="row">
        <div class="login-register-image col-md-4 col-md-offset-2">
            <img src="img/gps.png" alt="GPS Navigation">
        </div>

        <div id="register-form" class="col-md-4">
            @include('auth.forms.register');
        </div>
    </div>  
</section>

@endsection

