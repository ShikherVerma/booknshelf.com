<!-- Notifications -->
<li>
    <a @click="showNotifications" class="has-activity-indicator">
        <div class="navbar-icon">
            <i class="activity-indicator" v-if="hasUnreadNotifications"></i>
            <span class="icon icon-bell"></span>
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
            <a href="/{{ '@' . Auth::user()->username }}/bookshelves">
                My Bookshelves
            </a>
        </li>
        <li>
            <a href="/{{ '@' . Auth::user()->username }}">
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
            <a href="/logout">
                Logout
            </a>
        </li>
    </ul>
</li>