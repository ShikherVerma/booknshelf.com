@extends('layouts.app')

@section('content')

<section class="hero is-primary is-small is-bold">
    <div class="hero-body">
        <div class="container">
            <h3 class="title is-4 topic-title">
                <span class="primary-span" style="background-color: #144e45;">
                Explore some of our favorite bookshelves!
                </span>
            </h3>
        </div>
    </div>
</section>
<section id="favorite-shelves" class="section is-primary is-bold" v-cloak>
    <div class="container">
        <div class="columns is-multiline">
            @foreach ($shelves as $shelf)
                <div class="column is-3">
                    <a href="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}">
                        <div class="box shelf-item hvr-float"
                             style="background-image: url({{ $shelf['cover'] or '' }})"></div>
                    </a>
                    <h2 class="title">{{ $shelf['name'] }}</h2>
                    <p class="subtitle">{{ count($shelf['books']) }} books</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
