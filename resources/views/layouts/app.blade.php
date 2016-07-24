<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM" />

    <title>@yield('title', 'Booknshelf')</title>

    <link rel="icon" href="/img/favicon.ico" />

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ elixir('css/booknshelf.css') }}">

    <!-- Global App Object -->
    <script>
        window.App = <?php echo json_encode([
                'userId' => Auth::id(),
                'env' => config('app.env'),
                'csrfToken' => csrf_token(),
                'state' => [
                    'user' => Auth::user()
                ],
            ]
        ); ?>
    </script>
</head>
<body class="with-navbar">
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
            @include('modals.notifications')
            @include('modals.create-shelf')
            @include('modals.session-expired')
        @endif

        <!-- JavaScript -->
        <script src="//code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
        <script src="{{ elixir('js/booknshelf.js') }}"></script>
        <script src="/js/app.js"></script>

        @include('shared.flash')
        @include('shared.errors')
    </div>

</body>
</html>
