<template>
    <section class="hero is-primary is-bold">

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-2 profile-avatar-column">
                        <figure class="image is-128x128 is-clearfix">
                            <img :src="user.avatar">
                        </figure>
                    </div>
                    <div class="column is-half">
                        <h1 class="title">
                            {{ user.name }}
                        </h1>
                        <h2 class="subtitle is-4">
                            {{ '@' +  user.username }}
                        </h2>
                        <h2 class="subtitle">
                            {{ user.about }}
                        </h2>
                    </div>
                    <div class="column">
                        <div class="level-item">
                            <div class="level-left">
                                <div class="level-item">
                                    <p class="subtitle">Share your profile</p>
                                </div>
                                <div class="level-item">
                                    <a class="button is-medium twitter-tweet-button"
                                        :href="twitterShareUrl" target="_blank">
                                      <span class="icon">
                                         <i class="fa fa-twitter"></i>
                                      </span>
                                     </a>
                                </div>
                                <div class="level-item">
                                    <a class="button is-medium facebook-share-button"
                                       :href="facebookShareUrl"
                                       target="_blank">
                                      <span class="icon">
                                        <i class="fa fa-facebook"></i>
                                      </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            },
            twitterShareUrl: function() {
                return "http://twitter.com/intent/tweet?status=" +
                "Check out my profile on @booknshelf. " + window.location.href;
            },
            facebookShareUrl: function() {
                return "http://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "&title=" +
                 this.user.name + "'s profile on Booknshelf.";
            }
        },
    }
</script>

<style lang="css">
    .profile-avatar-column {
        width: 140px !important;
    }
</style>
