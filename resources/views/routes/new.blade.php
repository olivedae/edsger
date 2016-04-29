@extends('layouts.popup')
@section('title', 'Routes')
@section('header', 'Create a new route')

@section('content')

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Box Form -->
    <form action="{{ URL::route('create_route') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Description</label>

            <div class="col-sm-6">
                <input type="text" name="description" class="form-control" placeholder="Optional">
            </div>
        </div>

        <!-- Add task button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Route
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
