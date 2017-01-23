@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <tabs>
                <tab name="Profile Photo" :selected="true">
                    <settings-profile-photo :user="user"></settings-profile-photo>
                </tab>
                <tab name="Profile Information">
                    <settings-profile-info :user="user"></settings-profile-info>
                </tab>
                <tab name="Social">
                    <settings-profile-social
                        :user="user"
                        facebook_disconnect_url="{{ url('/disconnect/facebook') }}"
                        facebook_connect_url="{{ url('/auth/facebook') }}"
                    >
                    </settings-profile-social>
                </tab>
            </tabs>
        </div>
    </section>
@endsection
