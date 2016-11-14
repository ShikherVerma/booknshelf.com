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
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/img/logo.png" height="20" width="20" alt="brand">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <form class="navbar-form"  role="form" method="GET" action="{{ url('/books/search') }}">
                            <div class="input-group">
                              <input id="book-search" type="text" value="{{ $q or '' }}" class="form-control"
                                placeholder="Search for great books ..." name="q">
                              <span class="input-group-btn">
                                <button class="btn btn-default btn-search" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i> Search
                                </button>
                              </span>
                            </div>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            @includeIf('nav.user-right')
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
    <script src="https://use.fontawesome.com/d28dd28e24.js"></script>
</body>
</html>
