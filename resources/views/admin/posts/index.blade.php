@extends('layouts.default')

@section('pageTitle', 'sezione post Admin')

@section('content')
    <h1>lista post</h1>

    <a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>
    
    {{-- <ul>
    @foreach($posts as $post)
        <li>
            Titolo: {{ $post->title }} 
            <strong>opzioni admin: 
            <a href="{{ route('admin.posts.show', $post->id) }}">dettagli post</a>
            </strong>
        </li>
    @endforeach
    </ul> --}}

    <table>
        <thead>
           <tr>
                <th>ID</th>
                <th>TITLE</th>
                <th>CREATED AT</th>
           </tr> 
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if($post->cover_img)
                            <img src="{{ asset('storage/' . $post->cover_img) }}" style="width: 80px; max-height: 80px; object-fit: cover">
                        @endif
                    </td>
                    <td><a href="{{ route('admin.posts.show', $post->id) }}">dettagli post</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>




    
    
    <a href="{{ route('admin.index') }}">torna alla homeAdmin</a>
@endsection