@extends('layouts.default')

@section('pageTitle', 'dettaglio post/visitatore')

@section('content')
    <p>Titolo: {{ $post->title }}</p>
    <p>Contenuto: {{ $post->content }}</p>
    <p>Categoria: {{ $post->category ? $post->category->name : '-'}}</p>
    <p>
        Tags:
        @if(count($post->tags) > 0)
            @foreach($post->tags as $tag)
                {{$tag->name}}
            @endforeach
        @else 
            non ci sono tag selezionati   
        @endif
    </p> 
    <a href="{{ route('posts.index') }}">torna alla lista dei post</a>
    <a href="{{ route('index') }}">torna alla homepage</a>
@endsection