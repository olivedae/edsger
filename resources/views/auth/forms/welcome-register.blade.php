@if ($errors->any())
    <div class="alert alert-danger form-group">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="post" action="/register">
    {!! csrf_field() !!}

    <div class="row form-group">
        <div class="col-xs-6">
            <input type="text" name="firstname" class="form-control" placeholder="First name">
        </div>
        <div class="col-xs-6">
            <input type="text" name="lastname" class="form-control" placeholder="Last name">
        </div>
    </div> <!-- End of first and last name div -->

    <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div> <!-- End of email input div -->

    <div class="row form-group">
        <div class="col-xs-6">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="col-xs-6">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
        </div>
    </div> <!-- Enf of password div -->
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Sign up for free</button>
    </div>
</form> <!-- End of registration form -->
