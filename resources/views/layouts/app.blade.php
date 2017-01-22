<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM"/>
    <link rel="canonical" href="https://www.booknshelf.com/"/>
    <meta name="description"
          content="Discover great books, bookshelves on specific topics and share them with your friends."/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Booknshelf"/>
    <meta property="og:description" content="Discover great books and bookshelves on specific topics."/>
    <meta property="og:image" content="https://booknshelf.com/img/logos/black_big_logo.png"/>
    <meta property="og:url" content="https://www.booknshelf.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Booknshelf: Discover great books and bookshelves on different topics') }}</title>
    <link rel="icon" type="image/png" href="/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-96x96.png" sizes="96x96">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.0/css/hover-min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.1/css/bulma.css">
    <link rel="stylesheet" href="{{ elixir('css/booknshelf.css') }}">


    <!-- Scripts -->
    <script>
        window.App = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'userId' => Auth::id(),
            'env' => config('app.env'),
            'state' => [
                'user' => Auth::user()
            ]
        ]); ?>
    </script>
    @include('shared.analytics')
</head>
<body>
<div id="app">
    <!-- Navigation -->
@if (Auth::check())
    @include('nav.user')
@else
    @include('nav.guest')
@endif

<!-- Main Content -->
@yield('content')


<!-- Application Level Modals -->
    @if (Auth::check())
        <new-shelf-modal v-if="showNewShelfModal" @close="showNewShelfModal = false"></new-shelf-modal>
    @endif

    <section id="newsletter" class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup" class="columns is-vcentered">
                    <div class="column is-one-third is-left">
                        <p class="title">Boooknshelf <strong>Newsletter</strong></p>
                        <p class="subtitle">Get notified when new features are released!</p>
                    </div>

                    <div class="column">
                        <form
                            action="//booknshelf.us3.list-manage.com/subscribe/post?u=a18b6a0108993df0bc58f69ca&id=7e4f46c598"
                            method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                            class="validate" target="_blank" novalidate="novalidate">
                            <div id="mc_embed_signup_scroll">
                                <div class="control is-grouped">
                                    <div class="control has-icon is-expanded">
                                        <input type="email" value="" name="EMAIL" class="input is-flat required email"
                                               id="mce-EMAIL" placeholder="email address" required=""
                                               aria-required="true">
                                        <span class="icon is-small">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    <div class="control">
                                        <input type="submit" value="Subscribe" name="subscribe"
                                               id="mc-embedded-subscribe" class="button is-white is-outlined">
                                    </div>
                                </div>
                                <div id="mce-responses">
                                    <div class="notification is-danger response" id="mce-error-response"
                                         style="display:none"></div>
                                    <div class="notification is-success response" id="mce-success-response"
                                         style="display:none"></div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    <input type="text" name="b_b43b93fe633f0560b2a72a69c_52585e8803" tabindex="-1"
                                           value="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--End mc_embed_signup-->
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="content">
                <p>
                    <strong>Booknshelf</strong> by <a href="https:/tigran.nyc">Tigran Hakobyan</a>
                    <a class="icon" href="https://twitter.com/booknshelf">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a class="icon" href="https://facebook.com/usebooknshelf">
                        <i class="fa fa-facebook"></i>
                    </a>
                </p>
            </div>
        </div>
    </footer>

</div>

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
