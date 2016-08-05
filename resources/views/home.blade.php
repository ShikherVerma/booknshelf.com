@extends('layouts.app')

@section('content')

@include('landing.welcome-message')

<!-- Books Template -->
<div class="container max-width-1000 p-a">
    <div class="row">
        @foreach ($shelves as $shelf)
            <div class="col-md-3">
               <!--  Home Page Shelf Item -->
                <div class="panel shelf-card-item pos-r">
                    <a href="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}">
                        <div class="shelf-caption w-full pos-a">
                             {{ $shelf['name'] }}
                        </div>
                    </a>
                    <div class="shelf-card-actions-bar w-full pos-a">
                        <li class="list-group-item">
                            <div class="media">
                                <a class="media-left" href="#">
                                    <img class="app-nav-profile-photo small-profile-photo" src="{{ $shelf['user']['avatar'] }}">
                                </a>
                                <div class="media-body shelf-creator">
                                    <a href="{{ route('profile_path', ['username' => $shelf['user']['username']]) }}">
                                        <strong>by {{ $shelf['user']['name'] }}</strong>
                                        <small>{{ "@" . $shelf['user']['username'] }}</small>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </div>
                    <a href="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}">
                        <div>
                            <img class="media-object shelf-card-item-cover" width="300" height="300" src="{{ $shelf['cover'] or '' }}">
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
