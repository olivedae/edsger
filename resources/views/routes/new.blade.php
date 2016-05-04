@extends('layouts.popup')
@section('title', 'Routes')
@section('header', 'Create a new route')

@section('content')

<!-- Display Validation Errors -->
@include('common.errors')

<!-- New Route Form -->
<form action="{{ URL::route('create_route') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row form-group">
        <div class="col-md-6">
            <input type="text" name="name" id="name" class="form-control input-small" placeholder="Name">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-10">
            <input type="text" name="description" class="form-control input-small" placeholder="Description (optional)">
        </div>
    </div>

    <!-- Add task button -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus"></i>Create route
        </button>
    </div>
</form>

@endsection
