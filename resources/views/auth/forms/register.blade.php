 <div class="login-register-header">
    <div class="row">
        <div class="login-register-title col-md-7 text-left">
            Create an account
        </div>

        <div class="login-register-switch col-md-5 text-right">
            or <a href="{{ URL::route('login') }}">login</a>
        </div>
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
        <input type="text" name="firstname" class="form-control" placeholder="First name">
    </div>

    <div class="form-group">
        <input type="text" name="lastname" class="form-control" placeholder="Last name">
    </div>

    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div> 

    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>

    <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
    </div>

    <div class="checkbox col-md-7">
        <label class="control-label">
            <input type="checkbox" name="terms"> I agree to <a href="#">Hooked terms</a>
        </label>
    </div>

    <div class="form-group col-md-3 col-md-offset-1">
        <button type="submit" class="btn btn-primary">Register</button>
    </div> 

</form>

