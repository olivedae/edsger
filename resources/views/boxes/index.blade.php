@extends('layouts.popup')
@section('title', 'Boxes')
@section('header', 'Boxes')

@section('content')

<ol>
    @foreach($boxes as $box)
        <li><ul>
            <li>{{ $box->name }}</li>
            <li>
                <a href="/shares/boxes/new/{{ $box->id }}" class="btn btn-share">Share</a>
            </li>
            <li>
                <form action="/boxes/{{ $box->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button class="btn btn-delete">X</button>
                </form>
            </li>
        </ul></li>
    @endforeach
</ol>

@endsection
