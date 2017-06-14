@extends('layouts.app')

@section('content')
    <section class="section" style="background-color: #f2f2f2;">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    <aside class="menu">
                        <ul class="menu-list">
                            <li><a class="is-active" style="font-size: 25px;">Profile</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-8">
                    <settings-profile-photo :user="user"></settings-profile-photo>
                    <settings-profile-info :user="user"></settings-profile-info>
                    <settings-profile-social
                        :user="user"
                        facebook_disconnect_url="{{ url('/disconnect/facebook') }}"
                        facebook_connect_url="{{ url('/auth/facebook') }}"
                    >
                    </settings-profile-social>
                </div>
            </div>

<!--             <tabs>
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
            </tabs> -->
        </div>
    </section>
@endsection
