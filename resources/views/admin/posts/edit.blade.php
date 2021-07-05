@extends('layouts.default')

@section('pageTitle', 'dettaglio post Admin')

@section('content')
    <a href="{{ route('admin.index') }}">Torna alla homeAdmin</a>
    <a href="{{ route('admin.posts.index') }}">Torna alla lista dei post</a>
    <a href="{{ route('admin.posts.show', $post->id) }}">Torna al dettaglio del post</a>

    @include('partials.errorsBox')

    <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
        @csrf

        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}">

        <label for="content">Testo Post</label>
        <textarea name="content" id="content" rows="10">{{ $post->content }}</textarea>

        <label for="category">Categoria</label>
        <select name="category_id">
            <option value="">seleziona una categoria</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                {{ $category->id == old('category_id', $post->category_id) ? 'selected' : ''}}
                {{ $category->name }}
                </option>
            @endforeach
        </select>

        @foreach($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                {{ $post->tags->contains($tag) ? 'checked' : ''}}>
                {{ $tag->name }}
            </label>    
        @endforeach

        <input type="submit" value="Salva">
    </form>    
@endsection