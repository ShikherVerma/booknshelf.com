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

    <div class="notification"  style="background-color: #0BBCD6; color: hsl(48, 100%, 67%);" v-cloak>
        <div class="title is-4">
            <strong>Explore Other Topics</strong>
            <a href="/topics" style="color: white;">See all ></a>
        </div>
    </div>

    <topics :topics="{{ $otherTopics }}" :user="user" :user-topics="userTopics"></topics>

            @if (Auth::check())
                <book-save-modal :user="{{ $user }}" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
@endsection
