@extends('layouts.master')

@section('title', 'Edit Article')

@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Article</h2>
        </div>
    </div>
    <form method="POST" action="{{ route('articles.update', ['id' => $article->ArticleID]) }}">
        @csrf
        @method('PUT')
        <div class="card edit-card">
            <div class="form-group">
                <label for="title"><b>Title</b></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->Title }}">
            </div>
            <div class="form-group">
                <label for="description"><b>Description</b></label>
                <textarea id="description" class="form-control" name="description">{{ $article->Description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image"><b>Image URL</b></label>
                <input type="text" class="form-control" id="Image" name="Image" value="{{ $article->Image }}">
            </div>
            <div class="form-group">
                <label for="image_placement"><b>Image Placement</b></label>
                <select class="form-control" id="image_placement" name="image_placement">
                    <option value="Left" {{ $article->image_placement == 'Left' ? 'selected' : '' }}>Left</option>
                    <option value="Right" {{ $article->image_placement == 'Right' ? 'selected' : '' }}>Right</option>
                    <option value="None" {{ $article->image_placement == 'None' ? 'selected' : '' }}>None</option>
                </select>
            </div>
        </div>
        <br />
        <div class='footer-btn'>
            <button type="submit" class="update-btn btn btn-primary">Update</button>
            <a class="cancel-btn btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
        </div>
    </form>

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
