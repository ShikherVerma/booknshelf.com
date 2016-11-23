<ul class="nav navbar-nav hidden">
    <li><a href="#" data-action="growl">Growl</a></li><li>
        <a href="{{ route('profile_path', ['username' => Auth::user()->username]) }}">
            My Profile
        </a>
    </li>
    <li>
        <a href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
            My Bookshelves
        </a>
    </li>
    <li>
        <a href="/friends">
            My Friends
        </a>
    </li>
    <li>
        <a href="/settings">
            Settings
        </a>
    </li>
    <li class="divider"></li>
    <!-- Logout -->
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