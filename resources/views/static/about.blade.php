@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title is-2 about-title">
                    Hi! I'm Tigran Hakobyan, </br> the guy behind
                    <span class="about-booknshelf-tag hvr-bounce-out">
                        Booknshelf
                    </span>.
                </h1>
                <h2>
                    <figure class="hvr-bounce-in image is-128x128 about-bio-figure">
                        <img src="/img/tigran.jpg">
                    </figure>
                </h2>
            </div>
        </div>
    </section>
    <div class="section">
        <div class="container is-light">
            <div class="content">
                <div class="columns">
                    <div class="column is-3"></div>
                    <div class="column is-8">
                        <h2><strong>Q: What is Booknshelf?</strong></h2>
                        <p class="subtitle">
                            Booknshelf is a place where people can find great resources on different topics.
                            At this point it's only books.
                            You can also create bookshelves and save your favorite books in them.

                        </p>
                        <h2><strong>Q: What are the goals of the site? </strong></h2>
                        <p class="subtitle">
                            The goal of Booknshelf is eventually to be a hub where you
                            can find the best resources for any topic you want to learn about.
                        </p>
                        <h2><strong>Q: How does Booknshelf make money? </strong></h2>
                        <p class="subtitle">
                            asdasdsad
                        </p>
                        <h2><strong>Q: Where did you get your inspiration?</strong></h2>
                        <p class="subtitle">
                            Talk about nomad list, indie hackers, etc
                        </p>
                        <h2><strong>Q: What's the best way to contact you?</strong></h2>
                        <p class="subtitle">
                            The best way to contact me is to email <a href="mailto:tigran@booknshelf.com"
                                                                      class="about-link">tigran@booknshelf.com</a>.
                            Or you can always tweet me at <a class="about-link"
                                                             href="https://twitter.com/@tiggreen">@tiggreen</a> .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection