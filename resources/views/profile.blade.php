@extends('layouts.app')

@section('content')
    <div class="profile-page">
        {{--<div class="page-header header-filter" data-parallax="active"></div>--}}
        <profile :user="{{ $user }}" :shelves="{{ $shelves }}"></profile>
    </div>
@endsection
