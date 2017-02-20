<!-- Navbar For Authenticated Users -->
<nav class="nav" v-if="user">
    <div class="nav-left" style="padding-left: 30px;">
        <a class="nav-item is-active" style="font-weight: normal;" href="/">
            <span class="icon">
              <i class="fa fa-home"></i>
            </span>
            <span style="margin-left: 4px;">Home</span>
        </a>
        <a class="nav-item" style="font-weight: normal" href="/faq">
            FAQ
        </a>
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
    </div>

    <div class="nav-center">
        {{--<a class="nav-item has-activity-indicator" href="/topics">--}}
            {{--People--}}
            {{--<span class="tag is-primary" style="margin-left: 3px; height: 2em;">--}}
              {{--NEW--}}
            {{--</span>--}}
        {{--</a>--}}
        <a class="nav-item has-activity-indicator" href="/topics">
            Topics
            <i class="activity-indicator"></i>
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
    <div id="right-navbar" class="nav-right nav-menu" style="padding-right: 30px;">
        <a class="nav-item" @click="showNewShelfModal = true">
        <span class="icon">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <a class="nav-item" href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
            My Bookshelves
        </a>
        <a class="nav-item" href="/friends">
            Friends
        </a>
        <a class="nav-item" href="{{ route('profile_path', ['username' => Auth::user()->username]) }}">
            <figure class="image is-24x24" style="margin-right: 8px;">
                <img src="{{ Auth::user()->avatar }}">
            </figure>
            Profile
        </a>

        </span>
    </div>
</nav>
