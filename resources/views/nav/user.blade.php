<!-- NavBar For Authenticated Users -->
<app-navbar
    :user="user"
    :has-unread-notifications="hasUnreadNotifications"
    inline-template>
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
                    @includeIf('nav.user-left')
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @includeIf('nav.user-right')
                </ul>
            </div>
        </div>
    </nav>
</app-navbar>