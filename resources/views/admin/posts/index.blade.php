@extends('layouts.default')

@section('pageTitle', 'sezione post Admin')

@section('content')
    <h1>lista post</h1>

    <a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>
    
    <ul>
    @foreach($posts as $post)
        <li>
            Titolo: {{ $post->title }} 
            <strong>opzioni admin: 
            <a href="{{ route('admin.posts.show', $post->id) }}">dettagli post</a>
            </strong>
        </li>
    @endforeach
    </ul>
    
    
    <a href="{{ route('admin.index') }}">torna alla homeAdmin</a>
@endsection