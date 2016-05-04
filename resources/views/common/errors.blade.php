@if ($errors->any())
    <div class="alert alert-danger form-group">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
