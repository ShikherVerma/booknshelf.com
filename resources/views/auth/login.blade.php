@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-light">
            <div class="columns">
                <div class="column is-4">
                    <p class="title is-4">I love quotes so I've decided to fill this empty space with some of my favorites.</p>
                    <p class="title is-5">
                          <span class="icon">
                              <i class="fa fa-quote-right"></i>
                          </span>
                        The roots of education are bitter, but the fruit is sweet. - Aristotle
                    </p>
                    <p class="title is-5">
                        <span class="icon">
                            <i class="fa fa-quote-right"></i>
                        </span>
                        Most of my inspiration, if that's the word, came from books themselves. - Shelby Foote
                    </p>
                    <p class="title is-5">
                        <span class="icon">
                            <i class="fa fa-quote-right"></i>
                        </span>
                        Have the courage to follow your heart and intuition. They somehow know what you truly want to become.
                        - Steve Jobs
                    </p>
                </div>
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
                            <span><strong>Login with Goodreads</strong></span>
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-large fb-button" href="{{ url('/auth/facebook') }}">
                         <span class="icon">
                           <i class="fa fa-facebook"></i>
                         </span>
                            <span><strong>Login with Facebook</strong></span>
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-large twt-button" href="{{ url('/auth/twitter') }}">
                             <span class="icon">
                               <i class="fa fa-twitter"></i>
                             </span>
                            <span><strong>Login with Twitter</strong></span>
                        </a>
                    </p>
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}


                        <label class="label bigger-font-label">Username</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('username') ? ' is-danger' : '' }}" type="text"
                                   name="username"
                                   value="{{ old('username') }}" placeholder="What's your username?">
                            @if ($errors->has('username'))
                                <span class="help is-danger">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </p>

                        <label class="label bigger-font-label">Pasword</label>
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
                                <a type="button" name="register" class="button is-link"
                                    href="{{ url('/password/reset') }}">
                                    Forgot your password?
                                </a>
                            </p>
                        </div>

                        <div class="control">
                            <p class="control">
                                <button type="submit" name="register" class="button is-large is-primary is-outlined full-width-button">
                                    <strong>LOGIN</strong>
                                </button>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>
{{--<div class="container m-t-lg">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-6 col-md-offset-3">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Welcome back 👋</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<a class="btn btn-block btn-social btn-facebook" href="{{ url('/auth/facebook') }}">--}}
                      {{--<span class="fa fa-facebook"></span> Continue with Facebook--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<a class="btn btn-block btn-social btn-twitter" href="{{ url('/auth/twitter') }}">--}}
                      {{--<span class="fa fa-twitter"></span> Continue with Twitter--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">--}}
                        {{--{!! csrf_field() !!}--}}

                        {{--<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Username</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" class="form-control" name="username" value="{{ old('username') }}">--}}

                                {{--@if ($errors->has('username'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('username') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="password" class="form-control" name="password">--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" name="login" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Password?</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
