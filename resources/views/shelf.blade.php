@extends('layouts.app')

@section('content')
    <shelf :user="{{ $user }}" :books="{{ $books }}" :shelf="{{ $shelf }}"></shelf>
    <shelf-books :user="{{ $user }}" :books="{{ $books }}" :shelf="{{ $shelf }}"></shelf-books>
@endsection
