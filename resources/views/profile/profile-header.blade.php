<app-profile-header :user="user" inline-template>
    <div class="profile-header p-t-lg">
        <div class="container max-width-1000">
            <div class="container-inner ">
                <img class="img-circle media-object" :src="user.avatar">
                <h3 class="profile-header-user">@{{ user.name }}</h3>
                <p class="profile-header-bio">
                    @{{ user.about }}
                </p>
            </div>
        </div>

    </div>
</app-profile-header>
