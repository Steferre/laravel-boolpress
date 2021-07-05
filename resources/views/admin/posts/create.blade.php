@extends('layouts.default')

@section('pageTitle', 'dettaglio post Admin')

@section('content')
    <a href="{{ route('admin.index') }}">Torna alla homeAdmin</a>
    <a href="{{ route('admin.posts.index') }}">Torna alla lista dei post</a>

    @include('partials.errorsBox')

    <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title">

        <label for="content">Testo Post</label>
        <textarea name="content" id="content" rows="10"></textarea>

        <label for="category">Categoria</label>
        <select name="category_id">
            <option value="">seleziona una categoria</option>
            @foreach($categories as $category)
                <option value="{{ $category->name }}">
                {{ $category->id == old('category_id', '') ? 'selected' : ''}}
                {{ $category->name }}
                </option>
            @endforeach
        </select>

        
        @foreach($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                {{ $tag->name }}
            </label>    
        @endforeach

        <input type="submit" value="Invia">
    </form>
@endsection