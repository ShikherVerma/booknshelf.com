<template>
    <div>
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
                        <div class="column is-4">
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
                        <div class="column is-1">
                            <h3 class="subtitle" style="font-size:1.15rem; font-weight:500;">
                                <a @click="showUserFollowersModal = true"> {{ followersCount }} </br> Followers</a>
                            </h3>
                        </div>
                        <div class="column is-1">
                            <h3 class="subtitle" style="font-size:1.15rem; font-weight:500;">
                                <a @click="showUserFollowedUsersModal = true">{{ followingCount }} </br> Following</a>
                            </h3>
                        </div>
                        <div class="column">
                            <div class="level-item">
                                <div class="level-left">
                                    <p class="level-item" v-if="!canEditOrDelete">
                                        <a class="button is-light" :disabled="form.busy"
                                           :class="{ 'user-followed-button': isFollowedByAuthUser}"
                                           @click.stop.prevent="toggle()">
                                            <span v-if="!isFollowedByAuthUser"><strong style="color: #363636;">Follow</strong></span>
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
                </div>
            </div>
        </section>
        <user-followers-modal
            :user="user"
            v-if="showUserFollowersModal"
            @close="showUserFollowersModal = false"
            :following="userFollowing">
        </user-followers-modal>

        <user-followed-users-modal
            :user="user"
            v-if="showUserFollowedUsersModal"
            @close="showUserFollowedUsersModal = false"
            :following="userFollowing">
        </user-followed-users-modal>
    </div>
</template>

<script>
    export default {
        props: ['user', 'userFollowing', 'userFollowers', 'followersCount', 'followingCount'],

        data() {
            return {
                showUserFollowersModal: false,
                showUserFollowedUsersModal: false,
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
            },
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
        color: #363636 !important;
    }

    .user-followed-button:hover {
        color: #675f5f !important;
    }

    .profile-avatar-column {
        width: 140px !important;
    }
</style>
