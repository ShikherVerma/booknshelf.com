<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM"/>
    <link rel="canonical" href="{{ url()->current() }}"/>
    <meta name="description"
          content="People come to Booknshelf to create their online reading journey by organizing their books in shelves."/>
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM" />

    {{--Facebook meta tags--}}
    <meta property="fb:app_id" content="1899203000306326"/>
    <meta property="og:title" content="{{ $title or 'Stay organized with your books & read more' }}"/>
    <meta property="og:description"
          content="{{ $description or 'People come to Booknshelf to create their online reading journey by organizing their books in shelves.' }}"/>
    <meta property="og:image" content="{{ $ogImage or 'https://booknshelf.com/img/social/homepage-screenshot-social-main-new.png' }}"/>
    <meta property="og:image:height" content="717"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:site_name" content="Booknshelf"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url()->current() }}"/>

    {{--Twitter meta tags--}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description"
          content="{{ $description or 'People come to Booknshelf to create their online reading journey by organizing their books in shelves.' }}">
    <meta name="twitter:image"
          content="{{ $ogImage or 'https://booknshelf.com/img/social/homepage-screenshot-social-main-new.png' }}">
    <meta name="twitter:site" content="@booknshelf">
    <meta name="twitter:title"
          content="{{ $title or 'Stay organized with your books & read more' }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or 'Booknshelf' }}</title>
    <link rel="icon" type="image/png" href="/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-96x96.png" sizes="96x96">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.0/css/hover-min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
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

    @include('shared.newsletter')

    @include('shared.footer')


</div>

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>
@if (env('APP_ENV') == 'production')
    <script async src='https://www.google-analytics.com/analytics.js'></script>
@endif


</body>
</html>
