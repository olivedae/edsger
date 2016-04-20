@extends('layouts.app')

@section('title', 'Sign in')

@section('content')

<section id="sign-in-container">
    <div class="container">
        <div class="row login-register-top-buffer">

            <div class="login-register-image col-md-4 col-md-offset-2">
                <img src="img/gps.png" alt="GPS Navigation">
            </div> <!-- End of page image -->

            <div id="login-register-form" class="col-md-4">
                @include('auth.forms.login')
            </div> <!-- End of login form wrapper -->

        </div> <!-- End of row div -->
    </div> <!-- End of container div -->
</section> <!-- End of sign in section -->

@endsection
