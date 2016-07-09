@extends('layouts.app')

@section('content')
<!-- Shelf Header  Template -->
<div class="profile-header">
    <div class="container">
        <div class="container-inner">
            <h3 class="shelf-header-name">{{ $shelf->name }}</h3>
            <p class="shelf-header-desc">
                {{ $shelf->description or ''}}
            </p>
            <span class="shelf-header-owner">
                <img src="{{ Auth::user()->avatar }}" class="app-nav-profile-photo small-profile-photo">
                {{ $user->name }}
            </span>
        </div>
    </div>
</div>

<div class="container m-y-md">
    <app-shelf shelf="{{ $shelf }}" books="{{ $books }}"></app-shelf>

    <!-- Shelf Template -->
    <template id="shelf" :books="books">
        <div class="m-t">
            <div class="row">
                <span v-for="book in books">
                    <app-shelf-book-item :shelf="shelf" :book="book" ></app-shelf-book-item>
                </span>
            </div>
        </div>
        <span v-if="books.length < 1">There are no books in this bookshelf yet.</span>
    </template>

    <!-- Shelf Book Item Template -->
    <template id="shelf-book-item" :shelf="shelf" :book="book">
        <div class="col-md-3">
            <div class="panel book-card">
                <div class="book-card-body">
                    <h5 class="panel-title" >@{{ book.title }}</h5>
                    <div class="shelf-card-actions-bar">
                        <button class="btn btn-sm btn-danger-outline" @click="removeBookFromShelf()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

</div>
@endsection