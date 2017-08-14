@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <h3 class="title is-3">
                    Explore our curated topics and follow the ones that interest you.
                </h3>
            </div>
        </div>
    </section>
    <topics :topics="{{ $topics }}" :user="user" :user-topics="userTopics"></topics>
@endsection
