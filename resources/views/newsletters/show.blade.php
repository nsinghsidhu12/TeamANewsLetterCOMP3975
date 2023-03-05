@extends('layouts.master')

@section('title', 'Show Newsletter')

@section('content')

@foreach($newsletters as $item)

<article>
    <h2 class="text-center">{{ $item->ArticleTitle }}</h2>
    <section class="row">
        <div class="col">
            @if ($item->Image !== "None")
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