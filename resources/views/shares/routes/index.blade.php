@extends('layouts.popup')
@section('title', 'Routes')
@section('header', 'Shared users')

@section('content')

<ol>
    @foreach($route_shares as $share)
        <li>
            {{ $share->unwrap_from()->first_name }}

            {{ $share->unwrap_from()->last_name }}
        </li>
    @endforeach
</ol>

@endsection
