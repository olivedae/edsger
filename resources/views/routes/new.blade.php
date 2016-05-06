@extends('layouts.popup')
@section('title', 'Create a new route')
@section('header', 'Create a new route')

@section('content')

<!-- Display Validation Errors -->
@include('common.errors')

<!-- New Route Form -->
<form action="{{ URL::route('create_route') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row form-group">
        <div class="col-md-4 popup-sizeable-select-list">
            <label for="parent" class="control-label">Parent Box</label>
            <select name="parent" class="form-control">
                <option value="default">Home</option>
                @foreach ($boxes as $box)
                    <option value="{{ $box->id }}">{{ $box->name }}</option>
                @endforeach
            </select>
            <span class="caret select-caret"></span>
        </div>
        <div class="col-md-6">
            <label for="name" class="control-label">Name</label>
            <div class="input-group">
                <span class="input-group-addon" id="parent-box">/</span>
                <input type="text" name="name" id="name" class="form-control" aria-describedby="parent-box">
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <textarea name="description" class="form-control" placeholder="Description (optional)" rows="1"></textarea>
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
