@extends('layouts.master')

@section('content')
<h2>Search</h2>
    @if ($newsletters)
        <h3>Newsletters Found</h3>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Title</th>
                <th>Date</th>
                <th>Active Status</th>
                <th></th>
            </tr>
                @foreach ($newsletters as $item)
                    <tr>
                        <td>{{ $item->NewsletterID }}</td>
                        <td width="10%">{{ $item->Logo }}</td>
                        <td>{{ $item->Title }}</td>
                        <td>{{ $item->Date }}</td>
                        <td>{{ ($item->IsActive)? "Active" : "Not Active" }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('newsletters.show',$item->NewsletterID) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('newsletters.edit',$item->NewsletterID) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('newsletters.destroy',$item->NewsletterID) }}">Del</a>
                        </td>
                    </tr>
                @endforeach
        </table>
    @endif

    @if ($articles)
        <h3>Articles Found</h3>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Newsletter</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th></th>
            </tr>
                @foreach($articles as $item)
                    <tr>
                        <td>{{ $item->ArticleID }}</td>
                        @if ($item->newsletter)
                            <td>{{ $item->newsletter->Title }}</td>
                        @else
                            <td>None</td>
                        @endif
                        <td>{{ $item->Title }}</td>
                        <td>{{ $item->Description }}</td>
                        @if ($item->Image)
                            <td width="5%"><img src={{ $item->Image }} style="width: 150px;"></td>
                        @else
                            <td>None</td>  
                        @endif
                        <td>
                            <a class="btn btn-info" href="{{ route('articles.show',$item->ArticleID) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('articles.edit',$item->ArticleID) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('articles.destroy',$item->ArticleID) }}">Del</a>
                        </td>
                    </tr>
                @endforeach
        </table>
    @endif
</div>
@endsection