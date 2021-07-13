@extends('layouts.default')

@section('pageTitle', 'dettaglio post Admin')

@section('content')
    <h1>pagina dettagli singolo post</h1>

    
    <img src="{{ asset('storage/'. $post->cover_img) }}" style="width: 100px; max-height: 100px; object-fit: cover">
    

    <p>Titolo: {{ $post->title }}</p>
    <p>Testo del Post: {{ $post->content }}</p>
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
    <a href="{{ route('admin.posts.edit', $post->id) }}">modifica</a>
    @include('partials.deleteBtn', ['post' => $post])
    <a href="{{route('admin.posts.index')}}">torna alla lista dei post</a>    
@endsection