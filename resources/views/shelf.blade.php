@extends('layouts.app')

@section('content')
<div class="profile-header">
    <div class="container">
        <div class="container-inner">
            <img class="img-circle media-object" src="{{ $shelf['cover'] }}">
            <h3 class="profile-header-user">{{ $shelf['name'] }}</h3>
            <p class="profile-header-bio">
                {{ $shelf['description'] or ''}}
            </p>
        </div>
    </div>
</div>

<div class="container m-y-md">
    <app-books list="{{ $books }}"></app-books>

    <!-- Book List Template -->
    <template id="books-list">
        <div class="m-t">
            <div class="row">
                <span v-for="book in list">
                    <app-book-item :book="book" ></app-book-item>
                </span>
            </div>
        </div>
        <span v-if="list.length < 1">There are no books in this bookshelf.</span>
    </template>

    <!-- Book Item Template -->
    <template id="book-item" :book="book">

        <div class="col-md-3">
            <div class="panel panel-default panel-profile">
                <div class="panel-heading">
                    LINK TO Book
                </div>
                <div class="panel-body text-center">
                    <h5 class="panel-title">@{{ book.title }}</h5>
                    <p class="m-b-md">Something else here</p>
                    <button class="btn btn-danger-outline" @click="alert('shelf')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

    </template>

</div>
@endsection