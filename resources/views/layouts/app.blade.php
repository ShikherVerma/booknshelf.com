<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM" />
    <link rel="canonical" href="https://www.booknshelf.com/" />
    <meta name="description" content="Booknshelf is a place to discover great books, bookshelves and share them with your friends."/>
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Booknshelf" />
    <meta property="og:description"   content="Discover great books on specific topics" />
    <meta property="og:image"         content="https://booknshelf.com/img/logo.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Booknshelf') }}</title>
    <link rel="icon" href="/img/favicon.ico" />

    <!--     Fonts and icons     -->
   	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/booknshelf.css') }}">

    <!-- Scripts -->
    <script>
        window.App = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'userId' => Auth::id(),
            'state' => [
                'user' => Auth::user()
            ]
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
    @if (Auth::guest())
        <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    @else
        <nav class="navbar navbar-info">
    @endif
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/img/small-logo-white.png" height="35" width="35" alt="brand">
                </a>
            </div>
            <div class="navbar-collapse collapse" id="navbar-collapse-main">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::check())
                        <li><a href="profile/index.html">About</a></li>
                        {{--<form action="{{ url('/books/search') }}" class="navbar-form navbar-right" role="search" method="GET">--}}
                            {{--<div class="form-group form-white is-empty">--}}
                                {{--<input type="text" class="form-control" placeholder="Search for great books">--}}
                                {{--<span class="material-input"></span>--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini">--}}
                                {{--<i class="material-icons">search</i>--}}
                            {{--</button>--}}
                        {{--</form>--}}
                    @else
                        <li><a href="https://www.indiehackers.com/about">About</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                @if (Auth::guest())
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}" type="button" class="btn btn-info btn-round navbar-btn">Join</a></li>
                    </ul>
                @else
                    @includeIf('nav.user-right')
                @endif
            </div>
        </div>
        </nav>

        @yield('content')
        @if (Auth::check())
            {{--Create new shelf modal --}}
            <new-shelf-modal></new-shelf-modal>
        @endif

    </div>

    <!-- Scripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
    <script src="https://use.fontawesome.com/d28dd28e24.js"></script>
</body>
</html>
