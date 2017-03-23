@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <book-save-modal :user="user" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
    <section class="hero is-small is-primary is-bold">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h3 class="subtitle is-3" style="margin-bottom: 5px;">
                    Search for great books to save them in your shelves.
                </h3>
                <h4 class="subtitle is-4">Create your online reading presence 📚😍!</h4>
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
