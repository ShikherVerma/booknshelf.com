@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-small is-bold">
        <div class="hero-body">
            <div class="container">
                <h3 class="title is-3 topic-title">
                    <span class="primary-span">
                        Explore and follow the topics that interest you.
                    </span>
                </h3>
                <p class="subtitle is-4 topic-text">
                    Each topic is curated by us and they're always up-to-date.
                </p>
            </div>
        </div>
    </section>
    <topics :topics="{{ $topics }}" :user="user" :user-topics="userTopics"></topics>
@endsection
