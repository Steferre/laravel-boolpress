@extends('layouts.default')

@section('pageTitle', 'HomePage')

@section('content')
<p>Qui potrai vedere la lista dei post pubblicati</p>
<a href="{{ route('posts.index') }}">Vai alla lista dei post</a>
@endsection