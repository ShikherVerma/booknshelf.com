@extends('layouts.app')

@section('content')
<div class="container flex-container">
    <app-books list="{{ $books }}"></app-books>

    <!-- Book List Template -->
    <template id="books-list">
        <span v-for="book in list">
            <app-book-item :book="book" ></app-book-item>
        </span>
    </template>

    <!-- Book Item Template -->
    <template id="book-item">
        <div class="flex-item">
            <div class="flex-book-container">
                <!-- Book Cover Img -->
                <div class="flex-book-container-item">
                    <img style="width: 150px;" :src="book.image">
                </div>
                <!-- Book Info -->
                <div class="flex-book-container-item">
                    <div class="flex-container">
                        <div class="book-title">
                            @{{ book.title }}
                        </div>
                        <div class="book-author">
                            @{{ book.authors }}
                        </div>
                    </div>
                </div>
                <!-- Book Action Bars -->
                <div class="flex-book-container-item">
                    <a class="btn btn-default btn-sm" href="@{{ book.google_info_link }}" target="_blank">
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-default btn-sm" href="#" @click="showSavePopover()">
                        <i class="fa fa-list"></i> Save
                    </a>

                    <!-- Save Book to Bookshelf Popover -->
                    <div class="save-popover" v-if="show">
                        <i v-show="loading" class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                        <ul class="list-group" v-for="shelf in shelves">
                            <li id="@{{ book.id }}" class="list-group-item"
                                @click="saveBookToBookshelf()">@{{ shelf.name }}</li>
                        </ul>
                        <span @click="showNewBookshelfForm=!showNewBookshelfForm">Add New</span>
                        <!-- Add the book to a new bookshelf form -->
                        <form class="form-horizontal p-b-none m-b-none" role="form">
                            <div v-show="showNewBookshelfForm" class="input-group">
                                <input v-model="form.name" placeholder="Name" type="text" class="form-control" placeholder="Name">
                                <span class="help-block" v-show="form.errors.has('name')">
                                    @{{ form.errors.get('name') }}
                                </span>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default"
                                            @click.prevent="saveBookToNewBookshelf"
                                            :disabled="form.busy">
                                        Add
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="nice-work-popover" v-show="addSuccessPopover" transition="expand">
                        Greate! "This book" has been added to your bookshelf "this bookshelf".
                    </div>
                </div>
            </div>

        </div>
    </template>

</div>
@endsection