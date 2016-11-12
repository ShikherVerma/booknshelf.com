@extends('layouts.app')

@section('content')
<div class="container m-t-lg max-width-1000">
    <div class="row">
        <div class="col-md-8">
            <app-books v-bind:books="{{ $books }}" inline-template></app-books>
        </div>
        <div class="col-md-4">
            {{--@include('books.popular', ['mostSavedBooks' => $mostSavedBooks])--}}
        </div>
    </div>
</div>
<!-- Books Template -->
<template id="books">
    <ul class="list-group media-list media-list-stream">
        <app-book-item v-for="book in books" :book="book" inline-template></app-book-item>
        <span v-if="books.length < 1">We couldn't find any books with the given name.</span>
    </ul>
</template>

<template id="book-item" :book="book">
    <li class="media list-group-item p-a book-search-item parent">
        <a class="media-left" href="#">
            <img class="media-object img-circle img-circle-book-cover" data-action="zoom"
                 style="width: 150px;" :src="book.cover_image || book.image">
        </a>
        <div class="media-body">
            <div class="media-body-text">
                <div class="media-heading">
                    <h5>@{{ book.title }}</h5>
                </div>
                <p>
                    <span v-for="(author, index) in book.authors">
                        @{{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                    </span>
                </p>
            </div>
            <div class="media-footer hover-content">
                <small v-show="!saved">
                    <button class="btn btn-danger btn-sm btn-action" @click="showSaveModal()" type="button">
                        <span class="icon icon-add-to-list"></span> Save
                    </button>
                </small>
                <small v-show="saved">
                    <button class="btn btn-success btn-sm btn-action" @click="showSaveModal()" type="button">
                        <span class="icon icon-check"></span> Saved
                    </button>
                </small>
                <small>
                    <a class="btn btn-default btn-sm btn-action" v-bind:href="'@' + book.detail_page_url" target="_blank" type="button">
                        <i class="fa fa-amazon" aria-hidden="true"></i>
                    </a>
                </small>
                {{--@if(Auth::check())--}}
                    {{--@include('modals.book-item-save-modal')--}}
                {{--@else--}}
                    {{--@include('modals.please-login-modal')--}}
                {{--@endif--}}
            </div>
        </div>
    </li>
</template>
<!-- Book Item Template -->
@endsection