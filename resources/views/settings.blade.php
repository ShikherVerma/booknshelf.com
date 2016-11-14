@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                  <h2>Settings</h2>
                </div>
            </div>
        </div>
    </div>
    <settings-profile-photo :user="user"></settings-profile-photo>
    <settings-profile-info :user="user"></settings-profile-info>
    <settings-profile-social
        :user="user" facebook_disconnect_url="{{ url('/disconnect/facebook') }}">
    </settings-profile-social>
@endsection
