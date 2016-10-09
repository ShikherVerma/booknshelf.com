<!-- Create a new bookshelf -->
<li>
    <a @click="showCreateShelfModal">
        <div class="navbar-icon">
            <i class="fa fa-lg fa-plus"></i>
        </div>
    </a>
</li>
<!-- Notifications -->
<li>
    <a @click="showNotifications" class="has-activity-indicator">
        <div class="navbar-icon">
            <i class="activity-indicator" style="display: none;" v-if="hasUnreadNotifications"></i>
            <i class="fa fa-lg fa-bell"></i>
        </div>
    </a>
</li>

<li class="dropdown">
    <!-- User Photo / Name -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <img src="{{ Auth::user()->avatar }}" class="app-nav-profile-photo m-r-xs">
        <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="{{ route('profile_path', ['username' => Auth::user()->username]) }}">
                My Profile
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
</li>