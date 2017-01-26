@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-light">
            <div class="columns">
                <div class="column is-4">
                    <p class="title is-3">Why join Booknshelf?</p>
                    <p class="title is-4">
                          <span class="icon">
                            <i class="fa fa-check"></i>
                          </span>
                        Create bookshelves to save your favorite books. Stay organized!
                    </p>
                    <p class="title is-4">
                        <span class="icon">
                          <i class="fa fa-check"></i>
                        </span>
                        Recommend books to your friends and community. It's fun!
                    </p>
                    <p class="title is-4">
                        <span class="icon">
                          <i class="fa fa-check"></i>
                        </span>
                        Connect with your friends and see what they read!
                    </p>
                </div>
                <div class="column is-4">
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

                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <label class="label bigger-font-label">What's your name?</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" name="name"
                                   value="{{ old('name') }}" placeholder="e.g. Jon Snow">
                            @if ($errors->has('name'))
                                <span class="help is-danger">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </p>

                        <label class="label bigger-font-label">Choose an easy remembered username</label>
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

                        <label class="label bigger-font-label">Choose a strong password</label>
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
                <div class="column is-3">
                </div>
            </div>

        </div>
    </section>
@endsection
