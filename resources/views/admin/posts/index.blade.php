<h1>lista post</h1>

<a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>

<p>
    Titolo: {{ $posts[0]['title']}} 
    <strong>opzioni admin: <a href="{{ route('admin.posts.show', $posts[0]['id']) }}">dettagli post</a></strong>
</p>



<a href="{{ route('admin.index') }}">torna alla homeAdmin</a>