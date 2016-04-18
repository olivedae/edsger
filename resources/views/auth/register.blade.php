@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div id="register-container" class="container large-top-margin">
  <div class="row">
    <div class="large-form-image col-md-4 col-md-offset-2">
      <img src="img/gps.png" alt="GPS Navigation">
    </div>

    <div id="register-form" class="col-md-4">

      <div class="row form-header">
          <div class="login-register-header col-md-7 text-left">
            Create an account
          </div>
          <div class="login-register-switch col-md-5 text-right">
            or <a href="{{ URL::route('login') }}">login</a>
          </div>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger form-group">
          @foreach ($errors->all(':message') as $input_error)
            <p>{{ $input_error }}</p>
          @endforeach
        </div>
      @endif

      <form method="POST" action="/register">
        {!! csrf_field() !!}

        <div class="form-group">
          <input type="text" name="firstname" class="form-control input-lg" placeholder="First name">
        </div>

        <div class="form-group">
          <input type="text" name="lastname" class="form-control input-lg" placeholder="Last name">
        </div>

        <div class="form-group">
          <input type="email" name="email" class="form-control input-lg" placeholder="Email">
        </div> 

        <div class="form-group">
          <input type="password" name="password" class="form-control input-lg" placeholder="Password">
        </div>

        <div class="form-group">
          <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="Confirm password">
        </div>

        <div class="checkbox col-md-7">
          <label class="control-label">
            <input type="checkbox" class="form-control reformat-input-with-label" name="terms"> I agree to <a href="#">Hooked terms</a>
          </label>
        </div>

        <div class="form-group col-md-3 col-md-offset-1">
          <button type="submit" class="btn btn-primary btn-lg">Register</button>
        </div> 

      </form>
    </div>
  </div>  
</div>

@endsection

