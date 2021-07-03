<form action="{{ route('admin.posts.destroy', $post->id)}}" method="post" class="delete_form">
    @csrf

    @method('DELETE')

    <input type="submit" value="Cancella">
</form>