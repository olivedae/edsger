@extends('layouts.popup')
@section('title', 'Routes')
@section('header', 'Shared users')

@section('content')

<ol>
    @foreach($route_shares as $share)
        <li>
            {{ $share->first_name }}

            {{ $share->last_name }}
        </li>
    @endforeach
</ol>

@endsection
