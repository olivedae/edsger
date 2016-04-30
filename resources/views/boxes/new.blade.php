@extends('layouts.popup')
@section('title', 'Boxes')
@section('header', 'Create a new box')

@section('content')

<!-- Display Validation Errors -->
@include('common.errors')

<!-- New Route Form -->
<form action="{{ URL::route('create_box') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row form-group">
        <div class="col-md-6">
            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
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
            <i class="fa fa-plus"></i>Add box
        </button>
    </div>
</form>

@endsection
