@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <label class="label">Sign to easily create ...</label>
                    <p class="control">
                        <a class="button is-primary" href="{{ url('/auth/facebook') }}">
                         <span class="icon">
                           <i class="fa fa-facebook"></i>
                         </span>
                            <span>Continue with Facebook</span>
                        </a>
                    </p>
                    <p class="control">
                        <a class="button is-info" href="{{ url('/auth/twitter') }}">
                             <span class="icon">
                               <i class="fa fa-twitter"></i>
                             </span>
                            <span>Continue with Twitter</span>
                        </a>
                    </p>
                    <label class="label">Name</label>
                    <p class="control">
                        <input class="input" type="text" placeholder="Text input">
                    </p>
                    <label class="label">Username</label>
                    <p class="control has-icon has-icon-right">
                        <input class="input is-success" type="text" placeholder="Text input" value="bulma">
                        <span class="icon is-small">
                          <i class="fa fa-check"></i>
                        </span>
                        <span class="help is-success">This username is available</span>
                    </p>
                    <label class="label">Email</label>
                    <p class="control has-icon has-icon-right">
                        <input class="input is-danger" type="text" placeholder="Email input" value="hello@">
                        <span class="icon is-small">
                          <i class="fa fa-warning"></i>
                        </span>
                        <span class="help is-danger">This email is invalid</span>
                    </p>
                    <div class="control is-grouped">
                        <p class="control">
                            <button class="button is-primary">Submit</button>
                        </p>
                        <p class="control">
                            <button class="button is-link">Cancel</button>
                        </p>
                    </div>

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
