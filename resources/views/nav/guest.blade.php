<!-- NavBar For Guest Users -->
<div class="container top-container">
    <nav class="navbar navbar-inverse custom-navbar container max-width-1000">
            <div class="container navbar-outer">
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
                                @include('search.book-search-bar')
                            </a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/login" class="navbar-link">LOGIN</a></li>
                        <li><a href="/register" class="navbar-link">REGISTER</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    {{--@include('shared.topics-bar')--}}
</div>