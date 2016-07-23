@extends('layouts.app')

@section('content')
<div class="container m-t-lg">

    <div class="row">

        <div class="col-md-8 col-md-offset-1">
            <app-books books="{{ $books }}"></app-books>
        </div>

        <div class="col-md-3">
            <div class="alert alert-warning alert-dismissible hidden-xs" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <a class="alert-link" href="profile/index.html">Visit your profile!</a> Check your self, you aren't looking too good.
            </div>
        </div>

    </div>

</div>

<!-- Books Template -->
<template id="books">
    <ul class="list-group media-list media-list-stream">
        <app-book-item v-for="book in books" :book="book" ></app-book-item>
        <span v-if="books.length < 1">We couldn't find any book with the given name.</span>
    </ul>
</template>

<!-- Book Item Template -->
<template id="book-item" :book="book">
    <li class="media list-group-item p-a book-search-item" @mouseover="mouseOver">
        <a class="media-left" href="#">
            <img class="media-object img-circle img-circle-book-cover" style="width: 150px;" :src="book.image">
        </a>
        <div class="media-body">
            <div class="media-body-text">
                <div class="media-heading">
                    <small class="pull-right text-muted">
                        <!-- Recommend a book here -->
                        {{--<i class="fa fa-ellipsis-v" aria-hidden="true"></i>--}}
                    </small>
                    <h5>@{{ book.title }}</h5>
                </div>
                <p>
                    <span v-for="(index, author) in book.authors">
                        @{{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                    </span>
                </p>
            </div>
            <div class="media-footer book-search-item-footer" v-show="active">
                <small v-show="!saved">
                  <a class="btn btn-default btn-sm btn-action" href="#" @click="showSaveModal()">
                      <i class="fa fa-th-list"></i> Save
                  </a>
                </small>
                <small v-show="saved">
                  <a class="btn btn-success btn-sm btn-action" href="#" @click="showSaveModal()">
                      <i class="fa fa-check"></i> Saved
                  </a>
                </small>
                <small class="text-muted">
                    <a class="btn btn-default btn-sm btn-tiny" href="@{{ book.google_info_link }}" target="_blank">
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                    </a>
                </small>
                @include('modals.book-item-save-modal')
            </div>
        </div>
    </li>
</template>

@endsection