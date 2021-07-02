@extends('layouts.default')

@section('pageTitle', 'HomePage')

@section('content')
<h1>Benvenuto Visitatore</h1>
<p>Qui potrai vedere la lista dei post pubblicati</p>
<a href="{{ route('posts.index') }}">Vai alla lista dei post</a>
@endsection