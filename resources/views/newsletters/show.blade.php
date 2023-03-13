@extends('layouts.master')

@section('title', 'Show Newsletter')

@section('content')

@foreach ($newsletters as $item)
    <section>
        <div class="row">
            <div class="col text-center">
                <div>
                    <img src={{ $item->Logo }} style="width: 150px;">
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
                    <div class="float-start pe-4">
                @elseif ($item->ImagePlacement === "Right")
                    <div class="float-end ps-4">
                @endif
                <img src={{ $item->Image }} style="width: 300px;">
                </div>
            @endif
            <div>
                <p>{{ $item->Description }}</p>
            </div>
        </div>
    </section>
</article>

@endforeach

<a class="btn btn-primary mt-5" href="{{ route('newsletters.index') }}">Back</a>


@endsection