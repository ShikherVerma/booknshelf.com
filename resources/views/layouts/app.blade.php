<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM"/>
    <link rel="canonical" href="https://www.booknshelf.com/"/>
    <meta name="description"
          content="People come to Booknshelf to find the best books on specific topics and also to see what their friends are reading."/>

    {{--Facebook meta tags--}}
    <meta property="fb:app_id" content="1899203000306326" />
    <meta property="og:title" content="Discover great books and bookshelves on different topics." />
    <meta property="og:description"
          content="People come to Booknshelf to find the best books on specific topics and also to see what their friends are reading." />
    <meta property="og:image" content="https://booknshelf.com/img/social/homepage-screenshot-facebook1.png" />
    <meta property="og:image:height" content="717" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:site_name" content="Booknshelf" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.booknshelf.com" />

    {{--Twitter meta tags--}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description"
          content="People come to Booknshelf to find the best books on specific topics and also to see what their friends are reading">
    <meta name="twitter:image"
          content="https://booknshelf.com/img/social/homepage-screenshot-facebook.png">
    <meta name="twitter:site" content="@booknshelf">
    <meta name="twitter:title"
          content="Booknshelf: Discover great books and bookshelves on different topics.">

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
    <link rel="stylesheet" href="{{ elixir('css/booknshelf.css') }}">


    <!-- Scripts -->
    <script>
        window.App = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'userId' => Auth::id(),
            'env' => config('app.env'),
            'state' => [
                'user' => Auth::user(),
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

<!-- Application Level Modals -->
    @if (Auth::check())
        <new-shelf-modal v-if="showNewShelfModal" @close="showNewShelfModal = false"></new-shelf-modal>
    @else
        <please-login-modal v-if="plaseLoginModal" @close="plaseLoginModal = false"></please-login-modal>
    @endif

<!-- Main Content -->
    @yield('content')


    @if (url()->current() !== env('APP_URL') . '/story')
        @include('shared.newsletter')
    @endif

    @include('shared.footer')

</div>

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>
<script async src='https://www.google-analytics.com/analytics.js'></script>
<script async src="{{ elixir('js/autotrack.js') }}"></script>
</body>
</html>
