@extends('layouts.app')

@section('content')
    <profile :user="{{ $user }}" :shelves="{{ $shelves }}" :likes="{{ $likes  }}"></profile>
    <profile-shelves :user="{{ $user }}" :shelves="{{ $shelves }}"></profile-shelves>

    {{--Logout form--}}
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@endsection
