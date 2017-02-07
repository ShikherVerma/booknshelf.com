@extends('layouts.app')

@section('content')
    <section class="hero is-small is-light is-bold">
        <div class="hero-body">
            <div class="container">
                <h3 class="subtitle is-3">
                    Topics
                </h3>
            </div>
        </div>
    </section>
    <topics :topics="{{ $topics }}" :user="user"><topics>
@endsection