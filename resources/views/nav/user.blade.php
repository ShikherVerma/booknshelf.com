<!-- NavBar For Authenticated Users -->
<app-navbar
    :user="user"
    :has-unread-notifications="hasUnreadNotifications"
    inline-template>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container" v-if="user">
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
                <a class="navbar-brand" href="/home">
                    <!-- app -->
                    <img src="/img/mono-logo.png" style="height: 32px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @includeIf('nav.user-left')
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @includeIf('nav.user-right')

                    <!-- Notifications -->
                    <li>
                        <a @click="showNotifications" class="has-activity-indicator">
                            <div class="navbar-icon">
                                <i class="activity-indicator" v-if="hasUnreadNotifications"></i>
                                <i class="icon fa fa-bell"></i>
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
                            <!-- Impersonation -->
                            @if (session('impersonator'))
                                <li class="dropdown-header">Impersonation</li>

                                <!-- Stop Impersonating -->
                                <li>
                                    <a href="/app/kiosk/users/stop-impersonating">
                                        <i class="fa fa-fw fa-btn fa-user-secret"></i>Back To My Account
                                    </a>
                                </li>

                                <li class="divider"></li>
                            @endif

                            <!-- Developer -->
                            @if (Auth::user()->email == 'tik.hakobyan@gmail.com')
                                @include('nav.developer')
                            @endif

                            <li>
                                <a href="/tigran">
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="/tigran/bookshelves">
                                    My Bookshelves
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
                </ul>
            </div>
        </div>
    </nav>
</app-navbar>