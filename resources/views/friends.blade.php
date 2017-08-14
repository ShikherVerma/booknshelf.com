@extends('layouts.app')

@section('content')
    @if($isFacebookConnected)
        <section class="hero is-small is-primary is-bold">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        We've found
                        {{ count($friends) }}
                        of your friends on
                        <span class="facebook-span">
                            Facebook
                        </span> that use

                        <span class="primary-span">Booknshelf.</span>
                    </h1>
                </div>
            </div>
        </section>
    @endif
    @if (!$isFacebookConnected)
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-5">
                        <h1 class="title">
                            Connect your Facebook profile to see what your friends are reading. It's fun!
                        </h1>
                        <p class="control">
                            <a class="button is-large fb-button" href="{{ url('/auth/facebook')  }}">
                                <span class="icon">
                                    <i class="fa fa-facebook"></i>
                                </span>
                                <span>Connect to Facebook</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($isFacebookConnected)
        <section class="section is-primary is-fullheight is-bold">
            <div class="container">
                <div class="columns is-multiline">
                    @foreach ($friends as $friend)
                        <div class="column is-2">
                            <div class="card friend-card">
                                <div class="card-image">
                                    <figure class="image is-128x128 friend-card-image">
                                        <img src="https://booknshelf.imgix.net/profiles/{{ $friend->avatar }}?auto=format&auto=compress"
                                        alt="{{ $friend->name }}'s facebook profile picture">
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
        </section>
    @endif
@endsection
