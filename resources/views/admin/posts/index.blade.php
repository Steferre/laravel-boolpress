<h1>lista post</h1>

<a href="{{ route('admin.posts.create') }}">Crea un nuovo post</a>

<p>Titolo: {{ $posts[0]['title']}} <strong>opzioni admin:  </strong></p>



<a href="{{ route('admin.index') }}">torna alla homeAdmin</a>