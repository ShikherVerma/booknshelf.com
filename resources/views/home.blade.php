@extends('layouts.app')

@section('content')

@if (!Auth::check())
    @include('landing.welcome-message')
@endif

<!-- Books Template -->

<div class="container max-width-1000">
    <div class="row">
        <div class="col-md-9">
            <div id="fh5co-board" data-columns>
                @foreach ($shelves as $shelf)
                    <div class="item animate-box">
                        <div>
                            @if($shelf['cover'])
                                <a href="{{ $shelf['cover']}}" class="image-popup fh5co-board-img" title="{{ $shelf['name'] }}">
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

            <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <a class="alert-link" href="profile/index.html">Visit your profile!</a> Check your self, you aren't looking too good.
            </div>

            <div class="panel panel-default m-b-md hidden-xs">
                <div class="panel-body">
                    <ul class="media-list media-list-stream">
                        <li class="media m-b">
                            <div class="media-body">
                                <div class="media-body-actions">
<!--                                     <button class="btn btn-primary-outline btn-sm">
                                        <span class="icon icon-add-user"></span> Business
                                    </button> -->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
