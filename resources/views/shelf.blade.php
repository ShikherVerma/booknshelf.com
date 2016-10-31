@extends('layouts.app')

@section('content')
<!-- Shelf Header  Template -->
<div class="profile-header profile-header-shelf">
    <div class="container max-width-1000">
        <div class="container-inner">
            <h3 class="shelf-header-name">{{ $shelf->name }}</h3>
            <p class="shelf-header-desc">
                {{ $shelf->description}}
            </p>
            <span class="shelf-header-owner">
                <img src="{{ $user->avatar }}" class="app-nav-profile-photo small-profile-photo">
                by <a href="{{ route('profile_path', ['username' => $user->username]) }}">{{ $user->name }}</a>
            </span>
        </div>
    </div>
</div>

<div class="container max-width-1000 shelf-books-container">
    <div class="m-t">
        <div class="row">
            <app-shelf shelf="{{ $shelf }}" books="{{ $books }}"></app-shelf>
        </div>
    </div>
</div>

<!-- Shelf Template -->
<template id="shelf" :books="books">
    @if(!Auth::check())
        @include('modals.please-login-modal')
    @endif
    <app-shelf-book-item v-for="book in books" :shelf="shelf" :book="book" :user="{{ json_encode($user) }}"></app-shelf-book-item>
    <span v-if="books.length < 1">There are no books in this bookshelf yet.</span>
</template>

<!-- Shelf Book Item Template -->
<template id="shelf-book-item" :shelf="shelf" :book="book">
    <div class="col-md-3" v-cloak>
        <div class="panel panel-default m-b-md book-card">
            <div class="panel-body">
                <div id="book-card-actions">
                    <button v-show="!saved" class="btn btn-danger btn-sm" @click="showSaveModal()">
                        <span class="icon icon-add-to-list"></span> Save
                    </button>
                  <button v-show="onOwnProfile()"class="btn btn-default btn-sm" @click="removeBookFromShelf()">
                      <span class="icon icon-cross"></span> Delete
                  </button>
                </div>
                <div data-grid="images">
                    <img class="media-object" height="350px;" width="250px;" :src="book.cover_image || book.image">
                </div>
                <p>
                    <strong>@{{ book.title }}</strong>
                    <span v-for="(index, author) in book.authors" class="text-muted">
                        @{{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                    </span>
                </p>
                <a v-if="book.detail_page_url"  class="btn btn-default btn-sm btn-action" href="@{{ book.detail_page_url }}"
                   target="_blank" type="button"> <i class="fa fa-amazon" aria-hidden="true"></i> See on Amazon
                </a>
            </div>
        </div>
        @include('modals.book-item-save-modal')
    </div>
</template>

@endsection