<!-- Navbar For Authenticated Users -->
<nav class="nav" v-if="user">
    <div class="nav-left" style="padding-left: 15px;">
        <a class="nav-item" href="/">
            <span class="icon">
                <i class="fa fa-home"></i>
            </span>
        </a>
        <a class="nav-item" href="/faq">
            <span>FAQ</span>
        </a>
        <a class="nav-item" href="/blog">
            <span>Blog</span>
        </a>
        <a class="nav-item has-activity-indicator" href="/topics">
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
        <a class="nav-item" href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
            My Bookshelves
        </a>
        <a class="nav-item" href="{{ route('notes_path', ['username' => Auth::user()->username]) }}">
            My Notes
        </a>
        <a class="nav-item" @click="showNewShelfModal = true">
            <span class="icon">
                <i class="fa fa-plus"></i>
            </span>
        </a>
<!--         <a class="nav-item" @click="showNewShelfModal = true">
            <span class="icon">
                <i class="fa fa-bell"></i>
            </span>
        </a> -->
        <a class="menu nav-item">
            <img src="https://booknshelf.imgix.net/profiles/{{ Auth::user()->avatar }}?codec=mozjpeg&cs=strip&w=32&h=32&fit=crop&dpr=2" style="border-radius: 50%;">
        </a>
        <div class="navbar-profile-menu" style="display: none;">
            <aside class="menu">
                <ul class="menu-list" style="border-bottom: 1px solid #eaeaea;">
                    <li><a href="{{ route('profile_path', ['username' => Auth::user()->username]) }}" style="font-weight: bold;">My profile</a></li>
                </ul>
                <ul class="menu-list" style="border-bottom: 1px solid #eaeaea;">
                    <li><a href="/friends" style="font-weight: bold;">My friends</a></li>
                </ul>
                <ul class="menu-list" style="border-bottom: 1px solid #eaeaea;">
                    <li><a href="/settings">Settings</a></li>
                </ul>

                <ul class="menu-list">
                    <li>
                        <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </aside>
        </div>
    </div>




</nav>
