<form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>

    <div>
        <label for="thumbnail">Thumbnail</label>
        <input type="file" id="thumbnail" name="thumbnail">
    </div>

    <button type="submit">Send</button>
</form>
