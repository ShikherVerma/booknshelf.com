@extends('layouts.app')

@section('content')
<div class="container m-t-lg">

    @if (!$isFacebookConnected)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Connect your Facebook profile to see what bookshelves your friends have created.</div>
                    <div class="panel-body">
                        <a class="btn btn-block btn-social btn-facebook"
                           style="max-width: 400px !important;" href="{{ url('/auth/facebook')  }}">
                          <span class="fa fa-facebook"></span> Connect with Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($isFacebookConnected)
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ count($friends) }} Friends</div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        @foreach ($friends as $friend)
            <div class="col-md-3">
                <div class="panel panel-default panel-profile m-b-md">
                    <div class="panel-heading"></div>
                    <div class="panel-body text-center">
                        <a href="{{ route('profile_path', ['username' => $friend->username]) }}">
                            <img class="panel-profile-img" src="{{ $friend->avatar }}">
                        </a>
                        <h5 class="panel-title">
                            <a class="text-inherit" href="{{ route('profile_path', ['username' => $friend->username]) }}">
                                {{ $friend->name }}</a>
                        </h5>
                        <p class="m-b-md">{{ $friend->about }}</p>
                        <ul class="panel-menu">
                            <li class="panel-menu-item">
                                <a href="{{ route('bookshelves_path', ['username' => $friend->username]) }}"
                                    class="text-inherit">
                                    <h5 class="m-y-0">{{ $friend->shelves_count }}</h5> Bookshelves
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
