<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Booknshelf')</title>

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
                'state' => [],
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
            @include('modals.session-expired')
        @endif

        <!-- JavaScript -->
        <script src="https://use.fontawesome.com/61a1688424.js"></script>
        <script src="{{ elixir('js/booknshelf.js') }}"></script>
        <script src="/js/app.js"></script>

        @include('shared.flash')
        @include('shared.errors')
    </div>

</body>
</html>
