<div class="login-register-header">
    <div class="row">
        <div class="login-register-title col-md-5 text-left">
            Sign in
        </div>

        <div class="login-register-switch col-md-6 col-md-offset-1 text-right">
            or <a href="{{ URL::route('register') }}">create an account</a>
        </div>
    </div>
</div> <!-- End of form header -->

@if ($errors->any())
    <div class="alert alert-danger form-group">
        @foreach ($errors->all(':message') as $input_error)
            <p>{{ $input_error }}</p>
        @endforeach
    </div>
@endif

<form method="post" action="/login">
    {!! csrf_field() !!}

    <div class="form-group">
        <input type="email" name="email" class="form-control" id="email-input" placeholder="Email">
    </div>

    <div class="form-group">
        <input type="password" name="password" class="form-control" id="password-input" placeholder="Password">
    </div> 

    <div class="checkbox col-md-6">
        <label class="control-label">
            <input type="checkbox" name="remember_me"> Remember me
        </label>
    </div>
    
    <div class="form-group col-md-3 col-md-offset-3 text-left">
        <button type="submit" class="btn btn-primary">Sign in</button>
    </div> 

 </form> <!-- End of login form -->

