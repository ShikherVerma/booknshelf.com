@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title is-2">
                    <strong> Welcome to Booknshelf </strong>
                </h1>
                <h2 class="subtitle is-4">
                    Find the best books on different topics. The ones you'll read!
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

    <section class="section is-primary is-fullheight is-bold">
        <div class="container">
            <div class="title is-4">
                Explore Our Favorite Topics
                <a href="/topics">See all ></a>
            </div>
            <div class="tile is-ancestor">
                <div class="tile is-vertical is-8">
                    <div class="tile">
                        <div class="tile is-parent is-vertical">
                            <article onclick="window.location ='/topics/machine-learning'"
                                     class="hvr-glow tile is-child notification is-primary">
                                <p class="title">Machine Learning</p>
                                <p class="subtitle">Top tile</p>
                            </article>
                            <article onclick="window.location ='/topics/startups'"
                                     class="hvr-glow tile is-child notification is-warning">
                                <p class="title">Startups</p>
                                <p class="subtitle">Bottom tile</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article onclick="window.location ='/topics/personal-finance'"
                                     class="hvr-glow tile is-child notification is-info">
                                <p class="title">Personal Finance</p>
                                <p class="subtitle">With an image</p>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-parent">
                        <article onclick="window.location ='/topics/product-management'"
                                 class="hvr-glow tile is-child notification">
                            <p class="title">Product Management (PM)</p>
                            <p class="subtitle">Aligned with the right tile</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <article onclick="window.location ='/topics/leadership'"
                             class="hvr-glow tile is-child notification t-is-1">
                        <div class="content">
                            <p class="title">Leadership</p>
                            <p class="subtitle">With even more content</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="tile is-ancestor">
                <div class="tile is-parent is-3">
                    <article class="tile is-child notification t-is-2">
                        <p class="subtitle has-text-centered">
                            <strong>Help me by suggesting a topic you would like to see in
                                here.
                            </strong>
                        </p>
                        <p class="has-text-centered">
                            <a href="https://goo.gl/forms/CcCU1KSpmqFJeHzB3" type="button" target="_blank"
                               class="button hvr-glow is-primary" style="background-color: #1c51a6; color: white;">
                                <span class="icon">
                                  <i class="fa fa-smile-o"></i>
                                </span>
                                <span>Suggest your topic</span>
                            </a>
                        </p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification">
                        <p class="title">Two</p>
                        <p class="subtitle">Subtitle</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification">
                        <p class="title">Three</p>
                        <p class="subtitle">Subtitle</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification">
                        <p class="title">Four</p>
                        <p class="subtitle">Subtitle</p>
                    </article>
                </div>
            </div>

            <div class="tile is-ancestor">
                <div class="tile is-vertical is-8">
                    <div class="tile">
                        <div class="tile is-parent is-vertical">
                            <article onclick="window.location ='/topics/machine-learning'"
                                     class="hvr-glow tile is-child notification is-primary">
                                <p class="title">Machine Learning</p>
                                <p class="subtitle">Top tile</p>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article onclick="window.location ='/topics/personal-finance'"
                                     class="hvr-glow tile is-child notification is-info">
                                <p class="title">Personal Finance</p>
                                <p class="subtitle">With an image</p>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-parent">
                        <article onclick="window.location ='/topics/product-management'"
                                 class="hvr-glow tile is-child notification">
                            <p class="title">Product Management (PM)</p>
                            <p class="subtitle">Aligned with the right tile</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <article onclick="window.location ='/topics/leadership'"
                             class="hvr-glow tile is-child notification t-is-1">
                        <div class="content">
                            <p class="title">Leadership</p>
                            <p class="subtitle">With even more content</p>
                            <div class="content">
                                <!-- Content -->
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="tile is-ancestor">
                <div class="tile is-parent is-3">
                    <article class="tile is-child notification t-is-2">
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification">
                        <p class="title">Two</p>
                        <p class="subtitle">Subtitle</p>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification">
                        <p class="title">Three</p>
                        <p class="subtitle">Subtitle</p>
                    </article>
                </div>
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


            <div class="tile is-ancestor">
                <div class="tile is-parent is-6">
                    <article class="tile is-child notification">
                        <p class="title">Side column</p>
                        <p class="subtitle">With some content</p>
                        <div class="content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu
                                pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis
                                feugiat facilisis.</p>
                        </div>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article onclick="window.location ='https://goo.gl/forms/CcCU1KSpmqFJeHzB3'"
                        class="hvr-glow tile is-child notification has-text-centered">
                        <h1 class="title is-2">Suggest a topic</h1>
                        <span class="icon is-large">
                          <i class="fa fa-plus"></i>
                        </span>
                    </article>
                </div>
            </div>

        </div>

        </div>
    </section>

    <section class="section is-primary is-bold">
        <div class="container">
            <div class="title is-4">
                Explore Our Favorite Bookshelves
            </div>
            <div class="columns is-multiline">
                @foreach ($shelves as $shelf)
                    <div class="column is-3">
                        <a href="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}">
                            <div class="box shelf-item hvr-float" style="background-image: url({{ $shelf['cover'] or '' }})"></div>
                        </a>
                        <h2 class="title">{{ $shelf['name'] }}</h2>
                        <p class="subtitle">{{ count($shelf['books']) }} books</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
