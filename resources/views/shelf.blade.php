@extends('layouts.app')

@section('content')
    <shelf :user="{{ $user }}" :books="{{ $books }}" :shelf="{{ $shelf }}"></shelf>
    <shelf-books :user="{{ $user }}" :books="{{ $books }}" :shelf="{{ $shelf }}" :likes="userLikedBooks"
                 :saves="userSavedBooks"></shelf-books>
    @if (Auth::check())
        <book-save-modal :user="{{ $user }}" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @else
        <please-login-modal :show="plaseLoginModal"></please-login-modal>
    @endif
@endsection
