<app-profile-liked-shelves inline-template>
    <div class="container m-y-md">
        @foreach ($shelves as $shelf)
            <div class="media">
                <div class="media-left">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ $shelf->name }}</h4>
                    <p>{{ $shelf->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</app-profile-liked-shelves>
