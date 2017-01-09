<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM" />
    <link rel="canonical" href="https://www.booknshelf.com/" />
    <meta name="description" content="Discover great books, bookshelves on specific topics and share them with your friends."/>
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Booknshelf" />
    <meta property="og:description"   content="Discover great books and bookshelves on specific topics." />
    <meta property="og:image"         content="https://booknshelf.com/img/logos/black_big_logo.png" />
    <meta property="og:url" content="https://www.booknshelf.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Booknshelf') }}</title>
    <link rel="icon" type="image/png" href="/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/img/favicons/favicon-96x96.png" sizes="96x96">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/booknshelf.css') }}">
    {{--<link rel="stylesheet" href="{{ elixir('css/grid.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.0/css/hover-min.css">

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


        <footer class="footer">
            <div class="container">
                <p class="text-muted">Place sticky footer content here.</p>
            </div>
        </footer>

        <!-- Application Level Modals -->
        @if (Auth::check())
            <new-shelf-modal></new-shelf-modal>
        @endif

    </div>

    <!-- Scripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
    {{--<script src="//use.fontawesome.com/d28dd28e24.js"></script>--}}
</body>
</html>
