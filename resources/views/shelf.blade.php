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
                by <a href="/{{ '@' . $user->username }}">{{ $user->name }}</a>
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
    <div class="col-md-6 shelf-book-item">
        <div class="panel p-a">
            <a class="media-left">
                <img class="media-object" width="110px;" height="150px;" :src="book.image">
            </a>
            <div class="media-body">
                <div class="media-body-text">
                    <div class="media-heading">
                        <small v-show="onOwnProfile()" class="pull-right text-muted">
                            <button @click="removeBookFromShelf()" class="close">
                                <span class="icon icon-cross"></span>
                            </button>
                        </small>
                        <span class="shelf-book-item-title">
                            @{{ book.title }}
                        </span>
                        <small class="text-muted">
                            <a href="@{{ book.google_info_link }}" target="_blank">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>
                        </small>
                    </div>
                    <p>
                        <span v-for="(index, author) in book.authors">
                            @{{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                        </span>
                    </p>
                    <small v-show="!saved">
                        <button class="btn btn-default btn-sm btn-action" @click="showSaveModal()">
                            <span class="icon icon-add-to-list"></span> Save
                        </button>
                    </small>
                </div>
            </div>
        </div>
        @include('modals.book-item-save-modal')
    </div>
</template>

@endsection