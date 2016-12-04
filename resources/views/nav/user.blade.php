<!-- Navbar For Authenticated Users -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container navbar-outer max-width-1000" v-if="user">
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
            @includeIf('nav.brand')
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
                <li>
                    <a name="my-bookshelves" href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
                        MY BOOKSHELVES
                    </a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @includeIf('nav.user-right')
            </ul>
        </div>
    </div>
</nav
