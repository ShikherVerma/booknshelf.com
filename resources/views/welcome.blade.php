@extends('layouts.app')

@section('content')
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-half">
                        <h3 class="subtitle is-3">
                            👋 Welcome to Booknshelf!
                        </h3>
                        <form role="form" method="POST" action="{{ url('/user/welcome') }}">
                            {!! csrf_field() !!}
                            <label class="label bigger-font-label">* Let's choose a username for you. Maybe your first name?</label>
                            <p class="control">
                                <input class="input is-large {{ $errors->has('username') ? ' is-danger' : '' }}"
                                       type="text" name="username"  value="{{ $user->username }}" placeholder="Choose your username">
                                @if ($errors->has('username'))
                                    <span class="help is-danger">
                                        {{ $errors->first('username') }}
                                    </span>
                                @endif
                            </p>

                            <label class="label is-4">Tell us a bit about yourself</label>
                            <p class="control">
                                <input class="input is-large" type="text" name="about"
                                       placeholder="e.g. I'm an avid reader.">
                            </p>

                            <p class="control">
                                <button type="submit" name="register" class="button is-large is-primary">
                                    Save & Continue
                                </button>
                            </p>

                        </form>
                    </div>
                    <div class="column is-half">
                        @if (isset($user->goodreads_user_id))
                            <div class="box">
                                <p class="subtitle">
                                    👉 We are now importing your shelves from Goodreads. </br>
                                    It may take a minute or two
                                    until they show up in your profile.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
