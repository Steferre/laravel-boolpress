@extends('layouts.default')

@section('pageTitle', 'HomePage')

@section('content')
    <div class="contentBox">
        <h1>Benvenuto Visitatore</h1>
        <p>Usando il link sottostante potrai accedere alla sezione dei post. <br> Per avere la possibilita' di inserire, modificare e cancellare i tuoi post, ti invitiamo ad effettuare il login o la registrazione.</p>
        <a href="{{ route('posts.index') }}">Vai alla lista dei post</a>
        <p>post presenti attualmente: {{ count($posts) }}</p>
    </div>
@endsection