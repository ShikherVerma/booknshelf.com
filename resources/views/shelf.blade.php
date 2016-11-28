@extends('layouts.app')

@section('content')
    <div class="profile-page">
        <shelf :user="{{ $user }}" :books="{{ $books }}" :shelf="{{ $shelf }}"></shelf>
    </div>
@endsection