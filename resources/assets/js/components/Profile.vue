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
                            {{ '@' + user.username }}
                        </h2>
                        <h2 class="subtitle">
                            {{ user.about }}
                        </h2>
                    </div>
                    <div class="column">
                        <div class="level-item">
                            <div class="level-left">
                                <p class="level-item" v-if="!canEditOrDelete">
                                    <a class="button is-info" :disabled="form.busy"
                                       :class="{ 'user-followed-button': isFollowedByAuthUser}"
                                       @click.stop.prevent="toggle()">
                                        <span v-if="!isFollowedByAuthUser"><strong>Follow</strong></span>
                                        <span v-else><strong>Following</strong></span>
                                    </a>
                                </p>
                                <div class="level-item">
                                    <a class="button twitter-tweet-button"
                                       :href="twitterShareUrl" target="_blank">
                                      <span class="icon">
                                         <i class="fa fa-twitter"></i>
                                      </span>
                                    </a>
                                </div>
                                <div class="level-item">
                                    <a class="button facebook-share-button"
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
        props: ['user', 'userFollowing'],

        data() {
            return {
                form: new AppForm({
                    id: '',
                }),
            }
        },

        methods: {
            toggle() {

                if (!App.userId) {
                    Bus.$emit('showPleaseLoginModal');
                    return;
                }

                this.form.startProcessing();

                if (this.isFollowedByAuthUser) {
                    this.unfollow()
                } else {
                    this.follow()
                }
                this.form.finishProcessing();

            },

            follow() {
                App.post(`/follows`, this.form)
                    .then(() => {
                        Bus.$emit('loadUserFollowing');
                    }).catch(function (reason) {
                    console.log(reason);
                })
            },

            unfollow()
            {
                App.delete(`/follows/${this.user.id}`, this.form)
                    .then(() => {
                        Bus.$emit('loadUserFollowing');
                    }).catch(function (reason) {
                    console.log(reason);
                })
            }
        },

        mounted() {
            this.form.id = this.user.id;
        },

        computed: {
            canEditOrDelete() {
                return App.userId === this.user.id;
            },
            isFollowedByAuthUser: function () {
                return (this.userFollowing.indexOf(this.user.id) != -1)
            },
            twitterShareUrl: function () {
                return "http://twitter.com/intent/tweet?status=" +
                    "Check out my profile on @booknshelf. " + window.location.href;
            },
            facebookShareUrl: function () {
                return "http://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "&title=" +
                    this.user.name + "'s profile on Booknshelf.";
            }
        },
    }
</script>

<style lang="css">
    .user-followed-button {
        background-color: #FFDB4A !important;
        color: #675f5f !important;
    }

    .user-followed-button:hover {
        color: #675f5f !important;
    }

    .profile-avatar-column {
        width: 140px !important;
    }
</style>
