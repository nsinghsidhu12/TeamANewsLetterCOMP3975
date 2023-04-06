@extends('layouts.master')

@section('title', 'Create Article')

@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create Article</h2>
        </div>
    </div>
    <form method="POST" action="{{ route('articles.store') }}">
        @csrf
        <div class="card edit-card">
            <div class="form-group">
                <label for="title"><b>Title:</b></label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="description"><b>Description:</b></label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="image"><b>Image URL</b></label>
                <input type="text" class="form-control" id="Image" name="Image">
            </div>
            <div class="form-group">
                <label for="image_placement"><b>Image Placement:</b></label>
                <select name="image_placement" id="image_placement" class="form-control">
                    <option value="Left">Left</option>
                    <option value="Right">Right</option>
                </select>
            </div>
            <!--dropdown list of newsletter names with their ids-->
            <div class="form-group">
                <label for="newsletter_id"><b>Newsletter</b></label>
                <select class="form-control" id="newsletter_id" name="newsletter_id">
                    <option value="">None</option>
                    @foreach ($newsletters as $newsletter)
                        <option value="{{ $newsletter->NewsletterID }}">#{{ $newsletter->NewsletterID }} - {{ $newsletter->Title }}</option>
                    @endforeach
                </select>
            </div>
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
