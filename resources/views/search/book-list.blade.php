@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($books as $book)
        @include('search.book-list-item', $book)
    @endforeach
</div>
@endsection
