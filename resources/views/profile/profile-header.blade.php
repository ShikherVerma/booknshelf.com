<app-profile-header :user=user inline-template>
    <div class="profile-header">
        <div class="container">
            <div class="container-inner">
                <img class="img-circle media-object" src="{{ asset('img/avatar-dhg.png') }}">
                <h3 class="profile-header-user">Tigran Hakobyan</h3>
                <p class="profile-header-bio">
                    I wish i was a little bit taller, wish i was a baller, wish i had a girl… also.
                </p>
            </div>
        </div>

        <nav class="profile-header-nav profile-index-tabs">
            <ul class="nav nav-tabs" role="tablist">

                <li class="active" role="presentation">
                    <a href="#bookshelves" aria-controls="bookshelves" role="tab" data-toggle="tab">
                        Bookshelves
                    </a>
                </li>
                <li role="presentation">
                    <a href="#likes" aria-controls="likes" role="tab" data-toggle="tab">
                        Likes
                    </a>
                </li>

            </ul>
        </nav>


    </div>
</app-profile-header>