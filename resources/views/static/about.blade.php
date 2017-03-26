@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title is-2 about-title">
                    Hi I'm Tigran Hakobyan <br>and I'm building
                        Booknshelf.
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
                        <p class="subtitle"
                           style="font-family: 'Source Sans Pro', sans-serif; line-height: 150%; font-size: 19px;">
                            Booknshelf is a place to discover great books and bookshelves and share them with your
                            friends. People come to Booknshelf to find their next read, see what their friends are
                            reading and build their reading journey along the way. It's also a place where you can keep
                            track of your books and stay organized.
                        </p>
                        <h2><span class="primary-span">Q: What are the goals of the site? </span></h2>
                        <p class="subtitle"
                           style="font-family: 'Source Sans Pro', sans-serif; line-height: 150%; font-size: 19px;">
                            To be honest, I don't exactly know what's the long term goal of Booknshelf. However, I'm
                            sure I want it to be a community hub of book enthusiasts, learners, and readers. Some
                            people may come to Booknshelf to find their next read and some find great resources to
                            learn about different topics. I'm working super hard to take Booknshelf to that point!
                        </p>
                        <h2><span class="primary-span">Q: How does Booknshelf make money? </span></h2>
                        <p class="subtitle"
                           style="font-family: 'Source Sans Pro', sans-serif; line-height: 150%; font-size: 19px;">
                            Booknshelf does not make money at this point. My eventual goal is to work on Booknshelf
                            full-time. Yes, full-time 👌. However, this is still something I'm exploring. I'll probably
                            start with <a class="about-link" target="_blank"
                                          href="https://affiliate-program.amazon.com/">Amazon
                                Affiliate
                                Program</a> and then go from there. My first financial goal is
                            to make Booknshelf a self-sustainable side-project and I'm very inspired by <a
                                class="about-link" target="_blank"
                                href="https://twitter.com/csallen">Courtland Allen</a> who
                            runs <a href="https://www.indiehackers.com" target="_blank" class="about-link">Indie
                                Hackers</a>.
                        </p>
                        <h2><span class="primary-span">Q: How did I build Booknshelf?</span></h2>
                        <p class="subtitle"
                           style="font-family: 'Source Sans Pro', sans-serif; line-height: 150%; font-size: 19px;">
                            I'm a big <a
                                class="about-link" target="_blank"
                                href="https://laravel.com">Laravel</a>
                            fan so all the backend is built on Laravel. Laravel is a PHP framework. I
                            also love <a
                                class="about-link" target="_blank"
                                href="http://vuejs.org/">Vue.js</a>
                            and its amazing community so the entire front-end is powered by Vue.js. I also can't say
                            enough
                            good words about <a
                                class="about-link" target="_blank"
                                href="http://bulma.io">Bulma</a>, the CSS framework I've used for Booknshelf! It made my
                            life
                            so much easier! The data is stored in a <a
                                class="about-link" target="_blank"
                                href="https://mariadb.org/about/">MariaDB</a>
                            relational database which is a drop-in replacement for MySQL. If
                            you want to talk more about the tech stuff you can always contact me.
                        </p>
                        <h2><span class="primary-span">Q: Is there anyone you'd like to give credits to? 🤔</span></h2>
                        <p class="subtitle"
                           style="font-family: 'Source Sans Pro', sans-serif; line-height: 150%; font-size: 19px;">
                            Yes 😍! I'm incredibly grateful to the Open Source community for building the tools I've
                            been using for Booknshelf. Thank you. I'd also like to give credits to
                            <a class="about-link" target="_blank" href="https://unsplash.com/">Unplash</a> for letting
                            me use their amazing photos! They are so beautiful.
                        </p>
                        <h2><span class="primary-span">Q: What's the best way to contact you?</span></h2>
                        <p class="subtitle"
                           style="font-family: 'Source Sans Pro', sans-serif; line-height: 150%; font-size: 19px;">
                            The best way to contact me is to email <a href="mailto:tigran@booknshelf.com"
                                                                      target="_blank"
                                                                      class="about-link">tigran@booknshelf.com</a>.
                            Or you can always tweet me at <a class="about-link" target="_blank"
                                                             href="https://twitter.com/@tiggreen">@tiggreen</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
