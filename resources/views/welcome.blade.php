@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h2>Welcome to Booknshelf<h2>
                    <h4>
                        Booknshelf is a community to discover great bookshelves, see what others
                        are reading and keep track of your reading journey.
                    </h4>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/welcome') }}">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Choose your username</label>

                            <div class="col-md-6">
                                <input type="username" class="form-control" name="username" value="{{ $user->username }}">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tell us a bit about yourself</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="about">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <span>Continue if you agree with our <a>terms</a></span>
                                <button type="submit" name="continue" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Continue
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
