<app-profile-index user="{{ $user }}" inline-template>
    <div>
        <!-- Profile Header -->
        <div>
            @include('profile.profile-header')
        </div>

        <div class="tab-content">
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
