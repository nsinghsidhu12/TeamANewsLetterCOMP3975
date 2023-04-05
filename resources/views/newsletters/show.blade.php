@extends('layouts.master')

@section('title', 'Show Newsletter')

@section('content')
<div class="card display-card">
    @foreach ($newsletters as $item)
        <section>
            <div class="row">
                <div class="text-center col">
                    <div>
                        <img src={{ $item->Logo }} style="max-width: 150px;">
                    </div>
                    <div>
                        <h1>{{ $item->NewsletterTitle }}</h1>
                    </div>
                    <div>
                        <h3>Newsletter #{{ $item->NewsletterID }} - {{ $item->Date }}</h3>
                    </div>
                </div>
            </div>
        </section>
        @break
    @endforeach

    @foreach($newsletters as $item)

    <article>
        <h2 class="text-center">{{ $item->ArticleTitle }}</h2>
        <section class="row">
            <div class="col">
                @if ($item->Image !== null)
                    @if ($item->ImagePlacement === "Left")
                        <div class="float-start pe-4" style="width: 20%;">
                    @elseif ($item->ImagePlacement === "Right")
                        <div class="float-end ps-4" style="width: 20%;">
                    @endif
                    <img src={{ $item->Image }} style="max-width: 100%;">
                    </div>
                @endif
                <div>
                    @php
                        if (!str_contains($item->Description, "<p>")) {
                            $item->Description = "<p>" . $item->Description . "</p>";
                        }
                    @endphp
                    {!! html_entity_decode($item->Description) !!}
                </div>
            </div>
        </section>
    </article>

    @endforeach
</div>

<a style="margin-bottom: 2.5rem" class="mt-5 btn btn-primary" href="{{ URL::previous() }}">Back</a>


@endsection
