@extends('layouts.app')

@section('content')

@include('landing.welcome-message')

<!-- Books Template -->
<div class="container max-width-1000">
    <div class="row">
        <div class="col-md-9">
            <div id="fh5co-board" data-columns>
                @foreach ($shelves as $shelf)
                    <div class="item animate-box">
                        <div>
                            @if($shelf['cover'])
                                <a href="/{{ '@' . $shelf['user']['username'] . '/shelves/' . $shelf['slug'] }}"
                                   class="fh5co-board-img" title="{{ $shelf['name'] }}">
                                    <img src="{{ $shelf['cover']}}" alt="{{ $shelf['description'] or '' }}">
                                </a>
                            @endif
                        </div>
                        <a href="/{{ '@' . $shelf['user']['username'] . '/shelves/' . $shelf['slug'] }}">
                            <div class="fh5co-desc">{{ $shelf['name']}}</div>
                        </a>
                        <a href="/{{ '@' . $shelf['user']['username'] }}">
                            <div class="shelf-profile">
                                <img class="app-nav-profile-photo small-profile-photo" src="{{ $shelf['user']['avatar'] }}">
                                by {{ $shelf['user']['name'] }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-3">
            @include('books.popular', ['mostSavedBooks' => $mostSavedBooks])
            <div class="panel panel-default m-b-md hidden-xs">
                <div class="panel-body">
                    <h5>
                        Top Profiles
                    </h5>
                    <ul class="media-list media-list-users list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img class="media-object img-circle" src="{{ $user['avatar'] or '' }}">
                                    </a>
                                    <div class="media-body">
                                        <strong>{{ $user['name'] }}</strong>
                                        <small><a href="/{{ '@' . $user['username'] }}">{{ $user['username'] }}</a></small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
