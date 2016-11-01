@extends('layouts.app')

@section('title')
@endsection

@section('content')

<!-- Profile Header -->
<app-profile-header :user="{{ $user }}" inline-template>
    <div class="profile-header p-t-lg">

        <template v-if="user">
            <div class="container max-width-1000">
                <div class="container-inner ">
                    <img class="media-object" :src="user.avatar">
                    <h3 class="profile-header-user">@{{ user.name }}</h3>
                    <p class="profile-header-bio">
                        @{{ user.about }}
                    </p>
                </div>
            </div>
        </template>

        <nav class="profile-header-nav profile-index-tabs">
            <ul class="nav nav-tabs" role="tablist">

                <li class="active" role="presentation">
                    <a href="#bookshelves" aria-controls="bookshelves" role="tab" data-toggle="tab">
                        BOOKSHELVES
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</app-profile-header>


<div class="tab-content profile-tabs">
    <!-- All Shelves -->
    <div role="tabpanel" class="tab-pane active" id="bookshelves">
        @include('profile.profile-all-shelves')
    </div>
</div>

@endsection
