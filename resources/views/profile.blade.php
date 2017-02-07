@extends('layouts.app')

@section('content')
    <profile :user="{{ $user }}"></profile>
    @if (Auth::check())
        <book-save-modal :user="user" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif

    <section class="section profile-shelves-section">
        <div class="container">
            <tabs>
                <tab name="{{ count($shelves) }} Created Bookshelves" :selected="true">
                    <profile-shelves :user="{{ $user }}" :shelves="{{ $shelves }}"></profile-shelves>
                </tab>
                <tab name="{{ count($likedBooks) }} Liked Books">
                    <profile-likes :user="{{ $user }}" :books="{{ $likedBooks }}" :likes="userLikedBooks"
                                   :saves="userSavedBooks"></profile-likes>
                </tab>
            </tabs>
        </div>
    </section>

    {{--Logout form--}}
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@endsection
