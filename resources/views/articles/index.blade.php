@extends('layouts.master')

@section('title', 'Articles List')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Articles List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success create" href="{{ route('articles.create') }}">
                    Create New Article
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped">
        <thead class="table-header">
            <tr>
                <th>ID</th>
                <th>Newsletter</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($articles as $item)
            <tr>
                <td>{{ $item->ArticleID }}</td>
                @if ($item->newsletter)
                    <td>{{ $item->newsletter->Title }}</td>
                @else
                    <td>None</td>
                @endif
                <td>{{ $item->Title }}</td>
                <td>
                    @php
                        if (!str_contains($item->Description, "<p>")) {
                            $item->Description = "<p>" . $item->Description . "</p>";
                        }
                    @endphp
                    {!! html_entity_decode($item->Description) !!}</td>
                @if ($item->Image)
                    <td width="5%"><img src={{ $item->Image }} style="width: 150px;"></td>
                @else
                    <td>None</td>
                @endif
                <td>
                    <a class="btn btn-info" href="{{ route('articles.show', $item->ArticleID) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('articles.edit', $item->ArticleID) }}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('articles.destroy', $item->ArticleID) }}">Del</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection
