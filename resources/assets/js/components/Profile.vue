<template>
    <section class="hero is-primary is-bold">

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container">
                <figure class="image is-128x128 is-clearfix">
                    <img :src="user.avatar">
                </figure>
                <h1 class="title">
                    {{ user.name }}
                </h1>
                <h2 class="subtitle">
                    {{ user.about }}
                </h2>
                <h2>
                    <div class="level">
                        <div class="level-left">
                            <p class="control">
                                <a class="button is-primary" v-if="canEditOrDelete" href="/settings">
                                    <span class="icon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    <span>Settings</span>
                                </a>
                                <a class="button is-white is-outlined" v-if="canEditOrDelete"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="icon">
                                        <i class="fa fa-sign-out"></i>
                                    </span>
                                    <span>Logout</span>
                                </a>
                            </p>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <p>
                                    Share your profile
                                </p>
                            </div>
                            <div class="level-item">
                                <div id="#social">

                                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fbooknshelf.com&layout=button&size=small&mobile_iframe=true&appId=1899203000306326&width=59&height=20"
                                            width="59" height="20" style="border:none;overflow:hidden" scrolling="no"
                                            frameborder="0" allowTransparency="true"></iframe>

                                    <iframe id="twitter-widget-1" scrolling="no" frameborder="0"
                                            allowtransparency="true"
                                            class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                                            title="Twitter Tweet Button"
                                            src="http://platform.twitter.com/widgets/tweet_button.c4fd2bd4aa9a68a5c8431a3d60ef56ae.en.html#dnt=false&amp;id=twitter-widget-1&amp;lang=en&amp;original_referer=https://booknshelf.com&amp;related=tiggreen%3ACreator%20of%20Booknshelf&amp;size=m&amp;text=Find the best books on different topics. The ones you'll read!&amp;time=1485106087144&amp;type=share&amp;url=https%3A%2F%2Fbooknshelf.com&amp;via=booknshelf"
                                            style="position: static; visibility: visible; width: 61px; height: 20px;"
                                            data-url="https://booknshelf.com"
                                            data-size="large"></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </h2>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['user'],

        mounted() {
            console.log('Component ready.')
        },

         computed: {
            canEditOrDelete() {
                return App.userId === this.user.id;
            }
        },
    }






</script>

<style lang="css">
</style>
