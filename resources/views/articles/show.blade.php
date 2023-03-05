@extends('layouts.master')

@section('title', 'Show Article')

@section('content')

<article>
    <h2 class="text-center">{{ $article->Title }}</h2>
    <section class="row">
        <div class="col">
            <div class="float-start pe-4">
                <img src={{ $article->Image }} style="width: 300px;">
            </div>
            <div>
                <p>{{ $article->Description }}</p>
            </div>
        </div>
    </section>
</article>

<a class="btn btn-primary mt-5" href="{{ route('articles.index') }}">Back</a>


@endsection