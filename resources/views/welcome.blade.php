@extends('layouts.app')

@section('content')
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <h3 class="subtitle is-3">
                    Welcome to Booknshelf!
                </h3>
                <div class="columns">
                    <div class="column is-half">
                        <form role="form" method="POST" action="{{ url('/user/welcome') }}">
                            {!! csrf_field() !!}
                            <label class="label is-4">Choose your username</label>
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
                                    Continue
                                </button>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
