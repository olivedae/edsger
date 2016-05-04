@extends('layouts.popup')
@section('title', 'Routes')
@section('header', 'Routes')

@section('content')

<ol>
    @foreach($routes as $route)
        <li><ul>
            <li>{{ $route->name }}</li>
            <li>
                <a href="/shares/routes/new/{{ $route->id }}" class="btn btn-share">Share</a>
            </li>
            <li>
                <form action="/routes/{{ $route->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button class="btn btn-delete">X</button>
                </form>
            </li>
        </ul></li>
    @endforeach
</ol>

@endsection
