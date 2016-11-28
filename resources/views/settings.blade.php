@extends('layouts.app')

@section('content')
    <section class="section-full-screen">
        <settings-profile-photo :user="user"></settings-profile-photo>
        <settings-profile-info :user="user"></settings-profile-info>
        <settings-profile-social
            :user="user" facebook_disconnect_url="{{ url('/disconnect/facebook') }}">
        </settings-profile-social>
    </section>
@endsection
