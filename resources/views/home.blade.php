@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <book-save-modal :user="user" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title is-2">
                    <strong> Welcome to Booknshelf </strong>
                </h1>
                <h2 class="subtitle is-4">
                    Discover great books and bookshelves on different topics.
                </h2>
                <div class="columns">
                    <div class="column is-offset-one-quarter is-half">
                        <form role="form" method="GET" action="{{ url('/books/search') }}">
                            <p class="control has-icon">
                                <input class="input is-large" type="text" value="{{ $q or '' }}" name="q"
                                       placeholder="Search for great books ...">
                                <span class="icon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </p>
                            <input type="submit" style="display: none;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <home-books-section :books="{{ $featuredBooks }}" :user="user" :likes="userLikedBooks"
                        :saves="userSavedBooks" title="Today's Featured Books"></home-books-section>


    <section class="section is-primary is-fullheight is-bold" style="padding-bottom: 0px;" v-cloak>
        <div class="container">
            <div class="notification is-primary">
                <div class="title is-4">
                    <strong>Explore Our Favorite Topics</strong>
                    <a href="/topics" style="color: yellow;">See all ></a>
                </div>
            </div>
        </div>
    </section>

    <topics :topics="{{ $topics }}" :user="user" :user-topics="userTopics"></topics>

    <home-books-section :books="{{ $books }}" :user="user" :likes="userLikedBooks"
                        :saves="userSavedBooks" title="Explore Some of Our Favorite Books"></home-books-section>

    <div class="tile is-ancestor" style="display: none;">
        <div class="tile is-parent">
            <article class="tile is-child notification">
                <p class="title has-text-centered">Like Booknshelf? 😊</p>
                <p class="subtitle has-text-centered">Make a small donation to help me to keep the site
                    running!</span>
                <p class="has-text-centered">
                    <a class="button is-dark" href="https://paypal.me/tiggreen" target="_blank"
                       type="button" class="btn btn-bright">
                        <span class="icon">
                          <i class="fa fa-paypal"></i>
                        </span>
                        <span>MAKE A DONATION!</span>
                    </a>
                </p>
            </article>
        </div>
    </div>

    <section class="section is-primary is-bold" v-cloak>
        <div class="container">
            <div class="notification" style="background-color: hsla(171, 100%, 36%, 1); color: white;">
                <div class="title is-4">
                    <strong>Explore Our Favorite Bookshelves</strong>
                </div>
            </div>
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
