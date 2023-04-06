@extends('layouts.master')

@section('title', 'Edit Article')

@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Article</h2>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('articles.update', ['id' => $article->ArticleID]) }}">
        @csrf
        @method('PUT')
        <div class="card edit-card">
            <input type="hidden" name="url" value="{{ $url }}" />
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
                <input type="text" class="form-control" id="image" name="image" value="{{ $article->Image }}">
            </div>
            <div class="form-group">
                <label for="image_placement"><b>Image Placement</b></label>
                <select class="form-control" id="image_placement" name="image_placement">
                    <option value="Left" {{ $article->ImagePlacement === 'Left' ? 'selected' : '' }}>Left</option>
                    <option value="Right" {{ $article->ImagePlacement === 'Right' ? 'selected' : '' }}>Right</option>
                    <option value="None" {{ $article->ImagePlacement === 'None' ? 'selected' : '' }}>None</option>
                </select>
            </div>
            <!--dropdown list of newsletter names with their ids-->
            <div class="form-group">
                <label for="newsletter_id"><b>Newsletter</b></label>
                <select class="form-control" id="newsletter_id" name="newsletter_id">
                    <option value="">None</option>
                    @foreach ($newsletters as $newsletter)
                        @if ($newsletter->NewsletterID === $article->NewsletterID) 
                            <option selected value="{{ $newsletter->NewsletterID }}">#{{ $newsletter->NewsletterID }} - {{ $newsletter->Title }}</option>
                        @else
                            <option value="{{ $newsletter->NewsletterID }}">#{{ $newsletter->NewsletterID }} - {{ $newsletter->Title }}</option>
                        @endif
                    @endforeach
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
