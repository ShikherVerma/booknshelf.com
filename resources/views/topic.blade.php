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

    @if (Auth::check())
        <book-save-modal :user="{{ $user }}" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
@endsection
