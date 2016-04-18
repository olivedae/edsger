@extends('layouts.app')

@section('title', 'Sign in')

@section('content')

<div id="sign-in-container" class="container large-top-margin">
  <div class="row">
    <div class="large-form-image col-md-4 col-md-offset-2">
      <img src="img/gps.png" alt="GPS Navigation">
    </div>

    <div id="sign-in-form" class="col-md-4">

      <div class="row form-header">
          <div class="login-register-header col-md-5 text-left">
            Sign in
          </div>
          <div class="login-register-switch col-md-6 col-md-offset-1 text-right">
            or <a href="{{ URL::route('register') }}">create an account</a>
          </div>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger form-group">
          @foreach ($errors->all(':message') as $input_error)
            <p>{{ $input_error }}</p>
          @endforeach
        </div>
      @endif

      <form method="POST" action="/login">
        {!! csrf_field() !!}

        <div class="form-group">
          <input type="email" name="email" class="form-control input-lg" id="email-input" placeholder="Email">
        </div>

        <div class="form-group">
          <input type="password" name="password" class="form-control input-lg" id="password-input" placeholder="Password">
        </div> 

        <div class="checkbox col-md-6">
          <label class="control-label">
            <input type="checkbox" class="form-control reformat-input-with-label" name="remember_me"> Remember me
          </label>
        </div>
    
        <div class="form-group col-md-3 col-md-offset-2">
          <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
        </div> 

      </form>
    </div>
  </div>
</div>

@endsection
