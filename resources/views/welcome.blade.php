@extends('layouts.master')

@section('content')
<span style="font-size:xx-large;">Laravel with MySQL</span>
<p>
    <a href="{{ route('newsletters.index') }}">Newsletters</a>
    <br/>
    <a href="{{ route('articles.index') }}">Articles</a>
</p>
@endsection
