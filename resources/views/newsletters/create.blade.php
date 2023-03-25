@extends('layouts.master')
@section('title', 'Add Newsletter')
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Add New Newsletter</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('newsletters.index') }}"> Back</a>
</div>
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
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Title:</strong>
<input type="text" name="Title" class="form-control" placeholder="Title">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Date:</strong>
<input type="text" name="Date" class="form-control" placeholder="Date">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Active status:</strong>
<input type="text" name="Active" class="form-control" placeholder="Active">
</div>
</div>
<div class="form-group">
	<label for="Logo">Logo:</label>
	<input name="Logo" id="Logo" class="form-control" placeholder="Logo">
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
@endsection