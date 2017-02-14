@extends('layouts.app')

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

                    <form role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">


                        <label class="label bigger-font-label">Your New Pasword</label>
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

                        <label class="label bigger-font-label">Confirm Your Pasword</label>
                        <p class="control">
                            <input class="input is-large {{ $errors->has('password') ? ' is-danger' : '' }}" type="password"
                                   name="password_confirmation"
                                   placeholder="confirm your password">
                            @if ($errors->has('password_confirmation'))
                                <span class="help is-danger">
                                    {{ $errors->first('password_confirmation') }}
                                </span>
                            @endif
                        </p>

                        <div class="control">
                            <p class="control">
                                <button type="submit" name="register" class="button is-large is-primary is-outlined full-width-button">
                                    <strong>Reset Password</strong>
                                </button>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>

@endsection
