@extends('layouts.master')

@section('title', 'Edit NewsLetter')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit NewsLetter</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('newsletters.index') }}">&lt;&lt; Back</a>
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

    <form action="{{ route('newsletters.update',$newsletter->id) }}" method="POST">
        @csrf
        @method('PUT')

		<input type="hidden" name="id" value="{{ $newsletter->id }}" />
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="Title" value="{{ $newsletter->Title }}" class="form-control" placeholder="Newsletter">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date:</strong>
                    <input type="text" name="Date" value="{{ $newsletter->Date }}" class="form-control" placeholder="Date">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Active Status:</strong>
                    <input type="text" name="IsActive" value="{{ $newsletter->IsActive}}" class="form-control" placeholder="Active Status">
                </div>
            </div>
			<div class="form-group">
                <label for="image">Logo URL</label>
                <input type="text" class="form-control" id="image" name="image" value="{{$newsletter->Logo }}">
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
@endsection