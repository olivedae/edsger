@extends('layouts.popup')
@section('title', 'Boxes')
@section('header', 'Shared users')

@section('content')

<ol>
    @foreach($box_shares as $share)
        <li>
            {{ $share->first_name }}

            {{ $share->last_name }}
        </li>
    @endforeach
</ol>

@endsection
