@extends('layouts.app')

@section('content')
<div class="container search-container">
    @foreach ($books as $book)
        @include('search.book-search-content-item', $book)
    @endforeach
</div>
@endsection