@extends('layouts.app')
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

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
                        <h2><span class="primary-span">Q: What is Booknshelf?</span></h2>
                        <p class="subtitle">
                            Booknshelf is a place to discover great books and bookshelves. Find out what
                            your friends are reading and sharing your reading journey with them.
                        </p>
                        <h2><span class="primary-span">Q: What are the goals of the site? </span></h2>
                        <p class="subtitle" style="font-family: 'Source Sans Pro', sans-serif; line-height: 150%; font-size: 19px;">
                            The goal of Booknshelf to eventually become a learning hub for people. I know it's a long
                            term goal but I'm working very hard to get to that point. I want it to be a hub when people
                            can
                            find the best resources to learn about a spedicifc topic. For instance, if you want to learn
                            about
                            Web Design then Booknshelf would be the place to find the resources to get started. At this
                            point only books.
                            And yes, I want to make it as personalized as possible.
                        </p>
                        <h2><span class="primary-span">Q: How does Booknshelf make money? </span></h2>
                        <p class="subtitle">
                            Booknshelf does not make money at this point. Financially I want to work full time on Booknshelf.
                            However, this is something I'm exploring a
                            lot. I've applied to Amazon Affilicate Program when I first launched Booknshelf but got
                            rejected. I'm thinking
                            I'll apply again soon. I may add affiliate links to the books. My goal is to make Booknshelf
                            fully sustainable side to cover all the expenses it burns. I'm very inspired what Courtland has done with
                            Indie Hackers.
                        </p>
                        <h2><span class="primary-span">Q: Where did you get your inspiration?</span></h2>
                        <p class="subtitle">
                            My main inspiration is the future. How it will shape the education. I talk more about future
                            in my this <a
                                href="https://tigran.nyc/what-i-think-about-the-future-5f4cfb2ddccc#.agikduydk"
                                target="_blank">blog post</a>.
                        </p>
                        <h2><span class="primary-span">Q: How did I build Booknshelf?</span></h2>
                        <p class="subtitle">
                            My main inspiration is the future. How it will shape the education. I talk more about future
                            in my this <a
                                href="https://tigran.nyc/what-i-think-about-the-future-5f4cfb2ddccc#.agikduydk"
                                target="_blank">blog post</a>. Other than that
                        </p>
                        <h2><span class="primary-span">Q: What's the best way to contact you?</span></h2>
                        <p class="subtitle">
                            The best way to contact me is to email <a href="mailto:tigran@booknshelf.com"
                                                                      class="about-link">tigran@booknshelf.com</a>.
                            Or you can always tweet me at <a class="about-link"
                                                             href="https://twitter.com/@tiggreen">@tiggreen</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection