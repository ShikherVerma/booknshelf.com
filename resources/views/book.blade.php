@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <book-view-left :book="{{ $book }}" :user="{{ $user }}"></book-view-left>


                {{--<book-view-center>--}}

                {{--</book-view-center>--}}
                {{--<book-view-right>--}}

                {{--</book-view-right>--}}
            </div>
        </div>
    </section>


    @if (Auth::check())
        <book-save-modal :user="{{ $user }}" :book="bookSaveModalBook" :show="bookSaveModal"></book-save-modal>
    @endif
@endsection
