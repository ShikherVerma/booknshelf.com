<!-- NavBar For Guest Users -->
<nav class="navbar">
    <div class="container max-width-1000">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <div class="hamburger">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Branding Image -->
            @include('nav.brand')
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            {{--<ul class="nav navbar-nav">--}}
                {{--<li>--}}
                    {{--<a>--}}
                        {{--<form class="navbar-form"  role="form" method="GET" action="{{ url('/books/search') }}">--}}
                            {{--<div class="input-group">--}}
                                {{--<input id="book-search" type="text" value="{{ $q or '' }}" class="form-control"--}}
                                    {{--placeholder="Search for great books ..." name="q">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<button class="btn btn-info btn-search" type="submit">--}}
                                        {{--<i class="fa fa-search" aria-hidden="true"></i> Search--}}
                                    {{--</button>--}}
                                 {{--</span>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                {{--<li><a href="/login" class="navbar-link">Login</a></li>--}}
                {{--<li><a href="/register" class="navbar-link">JOIN</a></li>--}}
                <li><a href="/login" class="navbar-link">Home</a></li>
                <li><a href="/register" class="navbar-link">About</a></li>
                <li>
                    <a href="/register">
                        <button type="button" class="btn btn-info navbar-btn btn-pretty">JOIN</button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
