@extends('layouts.master')

@section('title', 'Edit Article')

@section('content')


    <div class="card edit-card">
        <form method="POST" action="{{ route('articles.update', ['id' => $article->ArticleID]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->Title }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" name="description">{{ $article->Description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image URL</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ $article->image }}">
            </div>
            <div class="form-group">
                <label for="image_placement">Image Placement</label>
                <select class="form-control" id="image_placement" name="image_placement">
                    <option value="Left" {{ $article->image_placement == 'Left' ? 'selected' : '' }}>Left</option>
                    <option value="Right" {{ $article->image_placement == 'Right' ? 'selected' : '' }}>Right</option>
                    <option value="None" {{ $article->image_placement == 'None' ? 'selected' : '' }}>None</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
        </form>
    </div>

    <a class="btn btn-secondary mt-3" href="{{ route('articles.index') }}">Cancel</a>

    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/ztgkkghs4mn1mcsmskcw6swfmfh7i2sp3l11dwv2l0qsulbr/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'link code',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
            menubar: false,
        });
    </script>

@endsection
