@extends('layouts.default')

@section('pageTitle', 'tag disponibili')

@section('content')
    <h1>Lista Tag disponibili</h1>
    <ul>
        @foreach($tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>
@endsection