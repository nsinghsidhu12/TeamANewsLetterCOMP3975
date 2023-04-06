@extends('layouts.master')

@section('content')
    <h2>Newsletter Project – Winter 2023</h2>
    <div class="card" style="width: 18rem; margin: auto;">
        <div class="card-header">
            Team members
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Atsuki Uchida - A01276342</li>
            <li class="list-group-item">Nhi Nguyen - A01256656</li>
            <li class="list-group-item">Noorarjun Sidhu - A01275087</li>
            <li class="list-group-item">Richard Fenton - A01294551</li>
        </ul>
    </div>

    <h2>Latest Active Newsletter</h2>
    <div style="margin-bottom: 2.5rem" class="card display-card">
        @foreach ($latestNewsletter as $item)
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
        @endforeach


        @foreach ($latestNewsletter as $item)
            <article>
                <h2 class="text-center">{{ $item->ArticleTitle }}</h2>
                <section class="row">
                    <div class="col">
                        @if ($item->Image !== null)
                            @if ($item->ImagePlacement === 'Left')
                                <div class="float-start pe-4" style="width: 20%;">
                                @elseif ($item->ImagePlacement === 'Right')
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
@endsection
