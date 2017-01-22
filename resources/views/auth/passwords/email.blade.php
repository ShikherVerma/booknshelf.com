@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <section class="section">
        <div class="container is-light">
            <div class="columns">
                <div class="column is-8">
                    @if (session('status'))
                        <div class="notification is-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}


                        <label class="label bigger-font-label">You must have added your email address to your profile in order
                            to reset your password. Otherwise <a href="http://twitter.com/tiggreen" target="_blank">tweet me</a>
                            and I'll send you a custom link for reset.</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('username') ? ' is-danger' : '' }}"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}" placeholder="What's your email?">
                            @if ($errors->has('email'))
                                <span class="help is-danger">
                                {{ $errors->first('email') }}
                            </span>
                            @endif
                        </p>

                        <div class="control">
                            <p class="control">
                                <button type="submit" name="register"
                                        class="button is-large is-primary is-outlined full-width-button">
                                    <strong>Send Password Reset Link</strong>
                                </button>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>

@endsection
