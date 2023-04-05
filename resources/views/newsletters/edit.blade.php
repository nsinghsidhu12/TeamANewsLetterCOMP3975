@extends('layouts.master')

@section('title', 'Edit NewsLetter')

@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit NewsLetter</h2>
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

    <form action="{{ route('newsletters.update', $newsletter->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card edit-card">
            <input type="hidden" name="id" value="{{ $newsletter->id }}" />
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label><b>Title:</b></label>
                        <input type="text" name="Title" value="{{ $newsletter->Title }}" class="form-control"
                            placeholder="Newsletter Title">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label><b>Date:</b></label>
                        <input type="text" name="Date" value="{{ $newsletter->Date }}" class="form-control"
                            placeholder="Enter Y-m-d format">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label><b>Active Status:</b></label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="IsActive" {{ $newsletter->IsActive == 1 ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label><b>Logo URL</b></label>
                        <input type="text" class="form-control" id="image" name="Logo" value="{{ $newsletter->Logo }}"
                            placeholder="Enter Logo URL">
                    </div>
                </div>
            </div>
        </div>

        <br />
        <button type="submit" class="update-btn btn btn-primary">Update</button>
        <a class="cancel-btn btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>

    </form>
@endsection
