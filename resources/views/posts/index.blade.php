<h1>lista dei post</h1>
<p>pagina provvisoria manca tutto il layout e il contenuto, <br> viene fatta solo per vedere se funzionano i vari collegamenti</p>

{{-- <p>esempio di un possibile post <a href="{{ route('posts.show') }}">dettagli post</a></p> --}}

<p>Titolo del post: <strong>{{ $posts[0]['title'] }}</strong> <a href="{{ route('posts.show', $posts[0]['id']) }}">dettagli</a></p>

<a href="{{ route('index') }}">torna alla homepage</a>