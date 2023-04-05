@extends('layouts.master')

@section('title', 'Create Newsletter')

@section('content')
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create Article</h2>
        </div>
    </div>
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
    <form action="{{ route('newsletters.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title"><b>Title:</b></label>
            <input type="text" name="Title" class="form-control" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="date"><b>Date:</b></label>
            <input type="text" name="Date" class="form-control" placeholder="Date">
        </div>
        <div class="form-group">
            <label for="active"><b>Active status:</b></label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="IsActive">
            </div>
        </div>
        <div class="form-group">
            <label for="logo"><b>Logo:</b></label>
            <input type="text" name="Logo" id="Logo" class="form-control" placeholder="Logo">
        </div>
        <br />
        <div class='footer-btn'>
            <button type="submit" class="btn btn-primary">Create Newsletter</button>
            <a class="cancel-btn btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
        </div>
    </form>
@endsection
