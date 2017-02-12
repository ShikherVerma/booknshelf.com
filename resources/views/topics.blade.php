@extends('layouts.app')

@section('content')
    <section class="hero is-blue is-small is-bold">
        <div class="hero-body">
            <div class="container">
                <h3 class="title is-3 topic-title">
                    <span class="primary-span">
                        Topics
                    </span>
                </h3>
                <p class="subtitle is-4 topic-text">

                    Each topic is curated by us with the help of our community. They are always up-to-date. We're
                    starting with 20 topics and will expend
                    soon as you suggest more. Follow your favorite topics here and explore great books on different
                    topics.
                </p>
            </div>
        </div>
    </section>
    <topics :topics="{{ $topics }}" :user="user" :user-topics="userTopics"><topics>
@endsection