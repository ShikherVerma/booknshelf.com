@extends('layouts.app')

@section('content')
    <section class="section">
        <book-info :user="{{ $user }}" :book="{{ $book }}"></book-info>
    </section>
@endsection
