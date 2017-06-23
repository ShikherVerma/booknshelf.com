@extends('layouts.app')

@section('content')

<section class="hero is-small">
    <div class="hero-body">
        <div class="container">
            <h3 class="title is-3">
                Explore some of our bookshelves that we've created for you!
            </h3>
        </div>
    </div>
</section>
<section id="favorite-shelves"  style="padding-top: 0px;" class="section is-primary is-bold" v-cloak>
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-3">
                <div class="content">
                    <p class="subtitle has-text-centered" style="margin-top:15%;">
                        <strong class="primary-span">
                            Would you like to feature your shelf here?
                        </strong>
                    </p>
                    <p class="has-text-centered">
                        <a href="https://goo.gl/forms/riwJ6CcbVbvPUOZl1" type="button" target="_blank"
                           class="button is-primary is-large hvr-glow">
                            <span><strong>Feature my bookshelf</strong></span>
                        </a>
                    </p>
                </div>
            </div>
            @foreach ($shelves as $shelf)
                <div class="column is-3">
                    <a href="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}">
                        <div class="box shelf-item hvr-float"
                             style='background-image: url("https://booknshelf.imgix.net/shelf-covers/{{ $shelf['cover'] }}?h=250&fit=crop&q=30")'></div>
                    </a>
                    <h2 class="title">{{ $shelf['name'] }}</h2>
                    <p class="subtitle">{{ count($shelf['books']) }} books</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
