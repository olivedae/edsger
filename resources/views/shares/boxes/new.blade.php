@extends('layouts.popup')
@section('title', 'Boxes')
@section('header', 'Share a box')

@section('content')

<!-- Display Validation Errors -->
@include('common.errors')

<form action="/shares/boxes/{{ $box->id }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <!-- Box name -->
    <div class="form-group">

        <div class="col-sm-6">
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>

        <label class="control-label">
            <input type="checkbox" name="edit"> Can edit</a>
        </label>
    </div>

    <!-- Add task button -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus"></i>Share Box
        </button>
    </div>
</form>

@endsection
