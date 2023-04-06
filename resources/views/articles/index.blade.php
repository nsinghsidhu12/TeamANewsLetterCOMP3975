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

    <table class="table table-striped table-bordered">
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
                    <td style="width: 5rem;">{{ $item->newsletter->Title }}</td>
                @else
                    <td>None</td>
                @endif
                <td style="width: 5rem;">{{ $item->Title }}</td>
                <td style="width: 30rem;">
                    @php
                        if (!str_contains($item->Description, '<p>')) {
                            $item->Description = '<p>' . $item->Description . '</p>';
                        }
                        $limitedDescription = implode(' ', array_slice(explode(' ', $item->Description), 0, 50)); // Limit to 50 words
                    @endphp
                    {!! html_entity_decode($limitedDescription) !!}
                    @if (str_word_count($item->Description) > 50)
                        <span class="text-muted">...</span>
                    @endif
                </td>
                @if ($item->Image)
                    <td width="5%"><img src={{ $item->Image }} style="width: 150px;"></td>
                @else
                    <td>None</td>
                @endif
                <td class="text-center">
                    <a class="btn btn-info" href="{{ route('articles.show', $item->ArticleID) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('articles.edit', $item->ArticleID) }}">Edit</a>
                    <form style="display: contents;" action="{{ route('articles.destroy', $item->ArticleID) }}" method="GET">
                        @csrf
                        <a class="btn btn-danger" href="{{ route('articles.destroy', $item->ArticleID) }}"
                            onclick="confirmDelete(event, {{ $item->ArticleID }})">Del</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
    <script>
        function confirmDelete(event, articleId) {
            event.preventDefault(); // prevent the default form submission
            if (confirm("Are you sure you want to delete the article with ID " + articleId + "?")) {
                event.target.closest('form').submit(); // submit the form if user confirms
            }
        }
    </script>
@endsection
