<app-profile-header inline-template>
    <div class="profile-header p-t-lg">
        <div class="container max-width-1000">
            <div class="container-inner ">
                <img class="img-circle media-object" src="{{ $user->avatar }}">
                <h3 class="profile-header-user">{{ $user->name }}</h3>
                <p class="profile-header-bio">
                    {{ $user->about }}
                </p>
            </div>
            <p class="profile-header-bio">
                <!-- Tweet your profile button -->
                <a href="https://twitter.com/share" class="twitter-share-button" data-size="large" data-text="Check out my bookshelves on @booknshelf" data-show-count="false" data-url="https://booknshelf.com/{{'@'.$user->username}}">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fbooknshelf.com/{{'@'.$user->username}}
                &layout=button&size=large&mobile_iframe=true&appId=1899203000306326&width=73&height=28" width="73" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
            </p>
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