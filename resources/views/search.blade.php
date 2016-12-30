@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <book-save-modal :user="user" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @else
        <please-login-modal :show="plaseLoginModal"></please-login-modal>
    @endif
    <search :books="{{ $books }}"><search>
@endsection
