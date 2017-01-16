@extends('layouts.app')

@section('content')
    <profile :user="{{ $user }}" :shelves="{{ $shelves }}" :likes="{{ $likes  }}"></profile>
    <profile-shelves :user="{{ $user }}" :shelves="{{ $shelves }}"></profile-shelves>
@endsection
