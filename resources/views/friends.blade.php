@extends('layouts.app')

@section('content')
    <section class="hero is-info">
        <div class="hero-body">
            @if (!$isFacebookConnected)
                <div class="container">
                    <h1 class="title">
                        Connect your Facebook profile to see what your friends are reading!
                    </h1>
                    <h2 class="subtitle">
                        <a class="button is-info" href="{{ url('/auth/facebook')  }}">
                            <span class="icon">
                                <i class="fa fa-facebook"></i>
                            </span>
                            <span>Connect with Facebook</span>
                        </a>
                    </h2>
                </div>
            @endif
            @if ($isFacebookConnected)
                <div class="container">
                    <h1 class="title">
                        {{ count($friends) }} friends on Booknshelf
                    </h1>
                </div>
            @endif
        </div>
    </section>
    <section class="section is-primary is-fullheight is-bold">
        <div class="container">
            <div class="columns is-multiline">
                @foreach ($friends as $friend)
                    <div class="column is-one-quarter">
                        <div class="card">
                            <div class="friend-card-image card-image">
                                <figure class="image is-4by3">
                                    <img src="{{ $friend->avatar }}" alt="Image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">
                                            <a href="{{ route('profile_path', ['username' => $friend->username]) }}">
                                                {{ $friend->name }}
                                            </a>
                                        </p>
                                        <p class="subtitle is-6">{{ '@'. $friend->username }}</p>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="{{ route('bookshelves_path', ['username' => $friend->username]) }}">
                                        {{ $friend->shelves_count }} Bookshelves
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>>
@endsection
