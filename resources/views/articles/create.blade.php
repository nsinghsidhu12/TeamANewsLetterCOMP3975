@extends('layouts.master')

@section('title', 'Create Article')

@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create Article</h2>
        </div>
    </div>
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
        <br />
        <div class='footer-btn'>
            <button type="submit" class="btn btn-primary">Create Article</button>
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
