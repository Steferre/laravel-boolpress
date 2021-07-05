@extends('layouts.default')

@section('pageTitle', 'HomePage Admin')

@section('content')
    <p>Benvenuto Utente Admin</p>
    <a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>
    <a href="{{ route('admin.posts.index') }}">Vai alla lista dei post</a>
    <a href="{{ route('admin.categories.index') }}">CATEGORIE</a>
    <a href="{{ route('admin.tags.index') }}">TAGS</a>
@endsection