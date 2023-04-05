@extends('layouts.master')

@section('content')
<h2>Search</h2>
    @if ($newsletters)
        @if (count($newsletters) > 0)
            <h3>Newsletters Found</h3>
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
                    @foreach ($newsletters as $item)
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
        @else
            <h3>No Newsletters Found</h3>
        @endif
    @endif

    @if ($articles)
        @if (count($articles) > 0)
            <h3>Articles Found</h3>
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
                            if (!str_contains($item->Description, "<p>")) {
                                $item->Description = "<p>" . $item->Description . "</p>";
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
                        <a class="btn btn-danger" href="{{ route('articles.destroy', $item->ArticleID) }}">Del</a>
                    </td>
                </tr>
            @endforeach
            </table>
            <div class="d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        @else
            <h3>No Articles Found</h3>
        @endif
    @endif
</div>
@endsection
