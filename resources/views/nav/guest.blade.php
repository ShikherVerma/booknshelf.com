<!-- NavBar For Guest Users -->
<nav class="nav">
    <div class="nav-left" style="padding-left: 15px;">
        <a class="nav-item" href="/">
            <span class="icon">
                <i class="fa fa-home"></i>
            </span>
        </a>
        <a class="nav-item" href="/faq">
            <span>FAQ</span>
        </a>
        <a class="nav-item" href="/story">
            <span>Blog</span>
        </a>
        <a class="nav-item" href="/topics">
            Topics
        </a>
        <a class="nav-item" href="/bookshelves">
            Bookshelves
        </a>
    </div>


    <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
    <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
    <span class="nav-toggle">
    <span></span>
    <span></span>
    <span></span>
  </span>

    <!-- This "nav-menu" is hidden on mobile -->
    <!-- Add the modifier "is-active" to display it on mobile -->
    <div id="right-navbar" class="nav-right nav-menu" style="padding-right: 15px;">
    @if (url()->current() !== env('APP_URL') && url()->current() !== env('APP_URL') . '/books/search')
        <a class="nav-item is-hidden-mobile">
            <form role="form" method="GET" action="{{ url('/books/search') }}">
                <p class="control has-icon" style="margin-bottom: 0px; width: 350px;">
                    <input class="input is-expanded" type="text" value="{{ $q or '' }}" name="q"
                           placeholder="Search books to add them to your shelves ...">
                    <span class="icon">
                        <i class="fa fa-search"></i>
                    </span>
                </p>
                <input type="submit" style="display: none;">
            </form>
        </a>
    @endif
    <span class="nav-item">
        <a class="button" href="/login">
                LOG IN
        </a>
        <a class="button is-primary" href="/register">
            <span><strong>SIGN UP</strong></span>
        </a>
    </span>
    </div>
</nav>

