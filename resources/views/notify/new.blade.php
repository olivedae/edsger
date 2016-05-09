@if ($errors->any())
    <div class="alert alert-danger form-group">
        @foreach ($errors->all(':message') as $input_error)
            <p>{{ $input_error }}</p>
        @endforeach
    </div>
@endif

<form action="/notify" method="POST">
    {{  csrf_field() }}

    <div class="row form-group">

    </div>

    <div class="row form-group">
        <div class="col-md-7">
            <input type="text" name="email" class="form-control" placeholder="Your email">
        </div>
        <div class="col-md-5">
            <button type="submit" class="btn btn-primary btn-block">
                Notify me of Edsger 1.0
            </button>
        </div>
    </div>
</form>
