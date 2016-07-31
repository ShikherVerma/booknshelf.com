@extends('layouts.app')

@section('title')
{{ $user->name }}'s profile on Booknshelf
@endsection

@section('content')
    <app-profile-index :user="{{ $user }}" :shelves="{{ $shelves }}" inline-template>
        <div>
            <!-- Profile Header -->
            <div>
                @include('profile.profile-header', $user)
            </div>

            <div class="tab-content profile-tabs">
                <!-- All Shelves -->
                <div role="tabpanel" class="tab-pane active" id="bookshelves">
                    @include('profile.profile-all-shelves')
                </div>
                <!-- All Liked Shelves -->
                <div role="tabpanel" class="tab-pane" id="likes">
                    @include('profile.profile-liked-shelves')
                </div>
            </div>

        </div>
    </app-profile-index>
@endsection
