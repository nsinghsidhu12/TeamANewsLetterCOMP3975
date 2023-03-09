<form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control-file" required>
    </div>
    <div class="form-group">
        <label for="image_placement">Image Placement:</label>
        <select name="image_placement" id="image_placement" class="form-control" required>
            <option value="left">Left</option>
            <option value="right">Right</option>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Article</button>
    </div>
</form>
