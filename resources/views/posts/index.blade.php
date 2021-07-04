@extends('layouts.default')

@section('pageTitle', 'sezione post/visitatore')

@section('content')
    <h1>lista dei post</h1>
    
    @foreach($posts as $post)
        <p>
            Titolo del post: <strong>{{ $post->title }}</strong>
            <a href="{{route('posts.show', $post->slug)}}">dettagli</a>
        </p>
    @endforeach
    

    <a href="{{ route('index') }}">torna alla homepage</a>
@endsection