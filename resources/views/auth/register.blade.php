@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-light">
            <div class="columns">
                <div class="column is-4">
                    <p class="subtitle">
                        We'll never post to any of the networks without your permission.
                    </p>
                    <p class="control">
                        <a class="button is-large goodreads-button"
                           href="{{ url('/auth/goodreads') }}">
                            <span class="icon">
                                <i class="icon-light"><span style="font-family:helvetica;">g</span></i>
                            </span>
                            <span><strong>Continue with Goodreads</strong></span>
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-large fb-button" href="{{ url('/auth/facebook') }}">
                         <span class="icon">
                           <i class="fa fa-facebook"></i>
                         </span>
                            <span><strong>Continue with Facebook</strong></span>
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-large twt-button" href="{{ url('/auth/twitter') }}">
                             <span class="icon">
                               <i class="fa fa-twitter"></i>
                             </span>
                            <span><strong>Continue with Twitter</strong></span>
                        </a>
                    </p>
                </div>
                <div class="column is-1">
                    <p class="subtitle">OR</p>
                </div>
                <div class="column is-4">
                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <label class="label bigger-font-label">* What's your name?</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" name="name"
                                   value="{{ old('name') }}" placeholder="e.g. Jon Snow">
                            @if ($errors->has('name'))
                                <span class="help is-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </p>

                        <label class="label bigger-font-label">* Choose a username that you will remember</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('username') ? ' is-danger' : '' }}" type="text"
                                   name="username"
                                   value="{{ old('username') }}" placeholder="e.g. I chose 'tigran' which is my name">
                            @if ($errors->has('username'))
                                <span class="help is-danger">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </p>

                        <label class="label bigger-font-label">* What's your email address?</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('email') ? ' is-danger' : '' }}" type="text"
                                   name="email"
                                   value="{{ old('email') }}" placeholder="e.g. avid-reader@gmail.com">
                            @if ($errors->has('email'))
                                <span class="help is-danger">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </p>

                        <label class="label bigger-font-label">* Choose a strong password</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('password') ? ' is-danger' : '' }}" type="password"
                                   name="password"
                                   placeholder="at least 6 characters">
                            @if ($errors->has('password'))
                                <span class="help is-danger">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </p>

                        <div class="control">
                            <p class="control">
                                <button type="submit" name="register" class="button is-large is-primary is-outlined full-width-button">
                                    <strong>JOIN</strong>
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
