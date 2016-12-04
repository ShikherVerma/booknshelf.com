<!-- NavBar For Guest Users -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container navbar-outer max-width-1000">
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
            <ul class="nav navbar-nav">
                <li>
                    <a>
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
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/login" class="navbar-link">LOGIN</a></li>
                <li><a href="/register" class="navbar-link">JOIN</a></li>
            </ul>
        </div>
    </div>
</nav>
