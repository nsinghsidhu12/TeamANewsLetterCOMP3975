@extends('layouts.master')

@section('title', 'Show Article')

@section('content')

    <div class="card display-card">
        <article>
            <h2 class="text-center">{{ $article->Title }}</h2>
            <section class="row">
                <div class="col">
                    @if ($article->Image)
                        @if ($article->ImagePlacement === 'Left')
                            <div class="float-start pe-4" style="width: 20%;">
                            @elseif ($article->ImagePlacement === 'Right')
                                <div class="float-end ps-4" style="width: 20%;">
                        @endif
                        <img src={{ $article->Image }} style="max-width: 100%;">
                </div>
                @endif
                <div>
                    <p>{{ $article->Description }}</p>
                </div>
    </div>
    </section>
    </article>
    </div>

    <a class="btn btn-primary mt-5" href="{{ URL::previous() }}">Back</a>


@endsection
