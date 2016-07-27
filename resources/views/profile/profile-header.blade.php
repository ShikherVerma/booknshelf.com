<app-profile-header :user=user inline-template>
    <div class="profile-header p-t-lg">
        <div class="container max-width-1000">
            <div class="container-inner ">
                <img class="img-circle media-object" src="{{ $user->avatar }}">
                <h3 class="profile-header-user">{{ $user->name }}</h3>
                <p class="profile-header-bio">
                    {{ $user->about }}
                </p>
            </div>
        </div>

        <nav class="profile-header-nav profile-index-tabs">
            <ul class="nav nav-tabs" role="tablist">

                <li class="active" role="presentation">
                    <a href="#bookshelves" aria-controls="bookshelves" role="tab" data-toggle="tab">
                        BOOKSHELVES
                    </a>
                </li>
                <li role="presentation">
                    <a href="#likes" aria-controls="likes" role="tab" data-toggle="tab">
                        LIKES
                    </a>
                </li>

            </ul>
        </nav>


    </div>
</app-profile-header>