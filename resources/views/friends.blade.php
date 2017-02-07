@extends('layouts.app')

@section('content')
    @if($isFacebookConnected)
        <section class="hero is-medium is-primary is-bold">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        We've found {{ count($friends) }} of your friends on Facebook that use Booknshelf.
                    </h1>
                    <h2 class="subtitle">
                        It would mean a lot to me if you could spread the word with your friends on Facebook or Twitter.
                    </h2>
                    <h2>
                        <div class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <div id="#social">
                                        <iframe id="twitter-widget-1" scrolling="no" frameborder="0"
                                                allowtransparency="true"
                                                class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                                                title="Twitter Tweet Button"
                                                src="http://platform.twitter.com/widgets/tweet_button.c4fd2bd4aa9a68a5c8431a3d60ef56ae.en.html#dnt=false&amp;id=twitter-widget-1&amp;lang=en&amp;original_referer=https://booknshelf.com&amp;related=tiggreen%3ACreator%20of%20Booknshelf&amp;size=m&amp;text=Find the best books on different topics. The ones you'll read!&amp;time=1485106087144&amp;type=share&amp;url=https%3A%2F%2Fbooknshelf.com&amp;via=booknshelf"
                                                style="position: static; visibility: visible; width: 61px; height: 20px;"
                                                data-url="https://booknshelf.com"></iframe>
                                        <iframe
                                            src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.booknshelf.com&layout=button&size=small&mobile_iframe=true&appId=1899203000306326&width=59&height=20"
                                            width="59" height="20" style="border:none;overflow:hidden" scrolling="no"
                                            frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </h2>
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
        </section>
    @endif
@endsection
