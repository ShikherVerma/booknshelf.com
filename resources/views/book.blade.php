@extends('layouts.app')

@section('content')
    <section class="section" style="background-color: #fafafa;">
        <div class="container">
            <div class="columns">
                <book-view-left :book="{{ $book }}" :user="{{ $user }}" :likes="userLikedBooks" :saves="userSavedBooks"></book-view-left>
                <book-view-right :book="{{ $book }}"></book-view-right>
                <book-view-center :book="{{ $book }}" :user="{{ $user }}"></book-view-center>
            </div>
        </div>
    </section>


    @if (Auth::check())
        <book-save-modal :user="{{ $user }}" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
@endsection
