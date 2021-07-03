<a href="{{ route('admin.index') }}">Torna alla homeAdmin</a>
<a href="{{ route('admin.posts.index') }}">Torna alla lista dei post</a>
<a href="{{ route('admin.posts.show', $posts[0]['id']) }}">Torna al dettaglio del post</a>

@include('partials.errorsBox')

<form action="{{ route('admin.posts.update', $posts[0]['id']) }}" method="post">
    @csrf

    @method('PUT')

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ $posts[0]['title'] }}">

    <label for="content">Testo Post</label>
    <textarea name="content" id="content" rows="10">{{ $posts[0]['content'] }}</textarea>
    {{-- <input type="text" name="content" id="content"> --}}

    <input type="submit" value="Salva">
</form>