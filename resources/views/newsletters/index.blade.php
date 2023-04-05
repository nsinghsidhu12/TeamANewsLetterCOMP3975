@extends('layouts.master')

@section('title', 'Newsletters List')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>Newsletters List</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success create" href="{{ route('newsletters.create') }}">
                Create New Newsletter
            </a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-striped table-bordered">
    <thead class="table-header">
        <tr>
            <th>ID</th>
            <th>Logo</th>
            <th>Title</th>
            <th>Date</th>
            <th>Active Status</th>
            <th></th>
        </tr>
    </thead>
@foreach($newsletters as $item)
    <tr>
        <td>{{ $item->NewsletterID }}</td>
        <td width="10%"><img src={{ $item->Logo }} style="width: 150px;"></td>
        <td>{{ $item->Title }}</td>
        <td>{{ $item->Date }}</td>
        <td>{{ ($item->IsActive)? "Active" : "Not Active" }}</td>
        <td class="text-center">
            <a class="btn btn-info" href="{{ route('newsletters.show',$item->NewsletterID) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('newsletters.edit',$item->NewsletterID) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('newsletters.destroy',$item->NewsletterID) }}">Del</a>
        </td>
    </tr>
@endforeach
</table>
<div class="d-flex justify-content-center">
    {{ $newsletters->links() }}
</div>
@endsection
