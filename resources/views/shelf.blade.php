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
                <img src="{{ $user->avatar }}" class="app-nav-profile-photo small-profile-photo">
                {{ $user->name }}
            </span>
        </div>
    </div>
</div>

<div class="container p-t-md">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <app-shelf shelf="{{ $shelf }}" books="{{ $books }}"></app-shelf>
        </div>
    </div>
</div>

<!-- Shelf Template -->
<template id="shelf" :books="books">
    @if(!Auth::check())
        @include('modals.please-login-modal')
    @endif
    <ul class="list-group media-list media-list-stream">
        <app-shelf-book-item v-for="book in books" :shelf="shelf" :book="book" :user="{{ json_encode($user) }}"></app-shelf-book-item>
        <span v-if="books.length < 1">There are no books in this bookshelf yet.</span>
    <ul>
</template>

<!-- Shelf Book Item Template -->
<template id="shelf-book-item" :shelf="shelf" :book="book">
    <li class="media list-group-item p-a book-search-item">
        <a class="media-left" href="#">
            <img class="media-object img-circle img-circle-book-cover" data-action="zoom" :src="book.image">
        </a>
        <div class="media-body">
            <div class="media-body-text">
                <div class="media-heading">
                    <small v-show="onOwnProfile()" class="pull-right text-muted">
                        <button @click="removeBookFromShelf()" class="close">
                            <i class="fa fa-times"></i>
                        </button>
                    </small>
                    <h5>@{{ book.title }}
                        <small class="text-muted">
                            <a href="@{{ book.google_info_link }}" target="_blank">
                                <i class="fa fa-external-link" aria-hidden="true"></i>
                            </a>
                        </small>
                    </h5>
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
        @include('modals.book-item-save-modal')
    </li>
</template>

@endsection