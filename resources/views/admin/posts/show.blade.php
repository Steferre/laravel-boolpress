<h1>pagina di prova dettagli singolo post</h1>

<p>
    esempio di testo del post
    <a href="#">modifica</a>
    <a href="#">
        @include('partials.deleteBtn', ['post' => $post])
    </a>
</p> 

<a href="{{route('admin.posts.index')}}">torna alla lista dei post</a>