<app-profile-header :user=user inline-template>
    <div class="profile-header">
        <div class="container">
            <div class="container-inner">
                <img class="img-circle media-object" v-bind:src="user.avatar">
                <h3 class="profile-header-user">@{{ user.name }}</h3>
                {{--<div class="panel panel-default panel-link-list">--}}
                    {{--Share your profile--}}
                    {{--<div class="panel-body">--}}
                        {{--<a href="https://twitter.com/intent/tweet?text=Check out my profile on @Booknshelf"--}}
                           {{--class="twitter-share-button" data-show-count="false" data-size="large">--}}
                        {{--</a>--}}
                        {{--<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>--}}
                        {{--<div class="fb-share-button" data-href="https://booknshelf.com/"--}}
                             {{--data-layout="button" data-size="large" data-mobile-iframe="true">--}}
                            {{--<a class="fb-xfbml-parse-ignore" target="_blank"--}}
                               {{--href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fbooknshelf.com%2F&amp;src=sdkpreparse">--}}
                                {{--Share</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <p class="profile-header-bio">
                    @{{ user.about }}
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