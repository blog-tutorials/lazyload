<form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title" id="title">

    <label for="thumbnail">Thumbnail</label>
    <input type="file" id="thumbnail" name="thumbnail">

    <button type="submit">Send</button>
</form>
