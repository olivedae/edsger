@extends('layouts.popup')
@section('title', 'Routes')
@section('header', 'Routes')

@section('content')

<ol>
    @foreach($permissions as $permission)
        <li>{{ $permission->route()->name }}</li>
    @endforeach
</ol>

@endsection
