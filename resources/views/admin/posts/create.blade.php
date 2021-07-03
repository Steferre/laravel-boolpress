<a href="{{ route('admin.index') }}">Torna alla homeAdmin</a>
<a href="{{ route('admin.posts.index') }}">Torna alla lista dei post</a>

@include('partials.errorsBox')

<form action="{{ route('admin.posts.store') }}" method="post">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title" id="title">

    <label for="content">Testo Post</label>
    <textarea name="content" id="content" rows="10"></textarea>
    {{-- <input type="text" name="content" id="content"> --}}

    <input type="submit" value="Invia">
</form>