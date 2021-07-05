@extends('layouts.default')

@section('pageTitle', 'categorie disponibili')

@section('content')
    <h1>Lista Categorie</h1>
    <ul>
        @foreach($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
@endsection