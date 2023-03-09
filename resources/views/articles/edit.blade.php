@extends('layouts.master')

@section('title', 'Edit Article')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit article</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('articles.index') }}">&lt;&lt; Back</a>
            </div>
        </div>
    </div>
    <br />
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->ArticleID) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="ArticleID" value="{{ $article->ArticleID }}" />
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Newsletter:</strong>
                    <input type="text" name="Newsletter" value="{{ $article->Newsletter }}" class="form-control" placeholder="Newsletter">
                </div>
            </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="Title" value="{{ $article->Title }}" class="form-control" placeholder="Title">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <input type="text" name="Description" value="{{ $article->Description }}" class="form-control" placeholder="Description">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
@endsection