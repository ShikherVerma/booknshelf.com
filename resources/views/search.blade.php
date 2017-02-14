@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <book-save-modal :user="user" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
    <section class="hero is-small is-primary is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h3 class="subtitle is-3">
                    Search for great books. You can like or save a book in your bookshelves.
                </h3>
                <div class="columns">
                    <div class="column is-offset-one-quarter is-half">
                        <form role="form" method="GET" action="{{ url('/books/search') }}">
                            <p class="control has-icon">
                                <input class="input is-large" type="text" value="{{ $q or '' }}" name="q"
                                       placeholder="Search for great books ...">
                                <span class="icon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </p>
                            <input type="submit" style="display: none;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <search :books="{{ $books }}" :user="user" :likes="userLikedBooks" :saves="userSavedBooks"></search>
@endsection
