@extends('layouts.app')

@section('content')
    <profile :user="{{ $user }}"></profile>

    <section class="section profile-shelves-section">
        <div class="container">
            <tabs>
                <tab name="{{ count($shelves) }} Bookshelves" :selected="true">
                    <profile-shelves :user="{{ $user }}" :shelves="{{ $shelves }}"></profile-shelves>
                </tab>
                <tab name="{{ count($likes) }} Likes">
                </tab>
            </tabs>
        </div>
    </section>

    {{--Logout form--}}
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@endsection
