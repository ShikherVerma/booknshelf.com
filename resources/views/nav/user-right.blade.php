<ul class="nav navbar-nav navbar-right">
    <li>
        <button type="button" class="btn btn-just-icon btn-simple btn-white" data-toggle="modal" data-target="#newShelfModal">
            <i class="material-icons">add_circle</i>
        </button>
        {{--<button class="btn btn-primary btn-round">--}}
            {{--Classic modal--}}
        {{--</button>--}}
    </li>
    <li class="dropdown">
            <a href="#" class="profile-photo dropdown-toggle" data-toggle="dropdown">
                <div class="profile-photo-small">
                    <img src="{{ Auth::user()->avatar }}" alt="Circle Image" class="img-circle img-responsive">
                </div>
            </a>
            <ul class="dropdown-menu">
                <li>
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
        </li>
</ul>
