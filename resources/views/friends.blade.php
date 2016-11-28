@extends('layouts.app')

@section('content')
<div class="container">

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
                <h2 class="title">{{ count($friends) }} Friends</h2>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        @foreach ($friends as $friend)
            <div class="col-md-3">
                <div class="card card-profile card-raised">
                    <div class="card-avatar">
                        <a href="{{ route('profile_path', ['username' => $friend->username]) }}">
                            <img class="img" src="{{ $friend->avatar }}" />
                        </a>
                    </div>
                    <div class="content">
                        <h4 class="card-title">{{ $friend->name }}</h4>
                        <h6 class="category text-muted">
                            <a href="{{ route('bookshelves_path', ['username' => $friend->username]) }}">
                                {{ $friend->shelves_count }} Bookshelves
                            </a>
                        </h6>

                        <p class="card-description">
                            {{ $friend->about or '' }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
