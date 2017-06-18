@extends('layouts.app')

@section('content')
    <topic-page
        :books="{{ $books }}"
        :topic="{{ $topic }}"
        :user="user"
        :likes="userLikedBooks"
        :saves="userSavedBooks"
        :user-topics="userTopics">
    </topic-page>

    <section class="section" style="padding-top: 5px; padding-bottom: 5px;">
        <div class="container">
            <div class="notification is-primary" v-cloak>
                <div class="title is-4">
                    Explore Other Topics
                    <a href="/topics" style="color: white;"><strong>See all ></strong></a>
                </div>
            </div>
        </div>
    </section>

    <topics :topics="{{ $otherTopics }}" :user="user" :user-topics="userTopics"></topics>

    @if (Auth::check())
        <book-save-modal :user="{{ $user }}" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
@endsection
