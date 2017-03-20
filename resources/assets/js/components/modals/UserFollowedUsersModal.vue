<template>
    <div class="modal is-active">
        <div class="modal-background" @click="$emit('close')"></div>
        <div class="modal-card user-followers-modal-content">
            <header class="modal-card-head" style="padding: 12px;">
                <p class="modal-card-title" style="font-size: 1.2rem;">FOLLOWING {{ followedUsers.length }}</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <div v-if="!loading && !followedUsers.length" class="columns">
                    <div class="column">
                        <div class="message is-primary">
                          <div class="message-body">
                              <p class="title has-text-centered">
                                  <span class="icon is-large">
                                    <i class="fa fa-users"></i>
                                  </span>
                              </p>
                              <h3 class="title has-text-centered" style="color: dimgray;">
                                  You haven't followed anyone yet.
                              </h3>
                              <p class="subtitle has-text-centered" style="color: dimgray;">
                                Follow people for always being up-to-date with their reading activity. Get notified
                                when they read a new book, follow topic and more.
                              </p>
                              <p class="subtitle has-text-centered">
                                  <a href="/friends" class="button is-medium is-primary">Follow my Facebook friends</a>
                              </p>
                          </div>
                        </div>
                    </div>
                </div>
                <article v-for="user in followedUsers"class="media">
                    <figure class="media-left">
                        <p class="image is-48x48">
                            <a :href="'/@' + user.username">
                                <img :src="user.avatar">
                            </a>
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p class="subtitle" style="margin-bottom: 3px;">
                                <a :href="'/@' + user.username">
                                    <strong class="user-title">{{ user.name }}</strong>
                                </a>
                            </p>
                            <h6 class="subtitle is-6" style="color: #6b6666;">{{ user.followers_count }} followers</h6>
                        </div>
                    </div>
                    <div class="media-right">
                        <!-- You can't follow yourself -->
                        <a v-if="!isFollowerYou(user.followed_id)" class="button is-primary is-outlined" :disabled="form.busy"
                            :class="{ 'user-followed-button-green': isFollowedByAuthUser(user.followed_id)}"
                            @click.stop.prevent="toggle(user.followed_id)">
                            <span v-if="!isFollowedByAuthUser(user.followed_id)">Follow</span>
                            <span v-else>Following</span>
                        </a>
                    </div>
                </article>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'following'],

        data() {
            return {
                loading: true,
                showUserFollowersModal: false,
                form: new AppForm({
                    id: '',
                }),
                followedUsers: []
            }
        },

        methods: {
            toggle(followerId) {
                if (!App.userId) {
                    // TODO: Should close user followers modal.
                    this.showUserFollowersModal = false;
                    Bus.$emit('showPleaseLoginModal');
                    return;
                }
                this.form.id = followerId;
                this.form.startProcessing();
                if (this.isFollowedByAuthUser(followerId)) {
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
                App.delete(`/follows/${this.form.id}`, this.form)
                    .then(() => {
                        Bus.$emit('loadUserFollowing');
                    }).catch(function (reason) {
                    console.log(reason);
                })
            },

            isFollowedByAuthUser(followerId) {
                if (App.userId) {
                    return (this.following.indexOf(followerId) != -1)
                } else {
                    return false;
                }
            },

            followerProfileUrl(username) {
                return '/@' . username;
            },

            isFollowerYou(followerId) {
                if (App.userId) {
                    return App.userId === followerId;
                } else {
                    return false;
                }
            }
        },

        mounted() {
            this.$http.get(`/users/${this.user.id}/followed`)
                .then(function(response) {
                    this.followedUsers = response.data;
                    this.loading = false;
                }).catch(function(reason) {
                    console.log(reason);
            });
        },
    }
</script>

<style type="text/css">
    .user-followed-button-green {
        background-color: #00D1B2 !important;
        color: white !important;
    }
    .user-title:hover {
        color: #00D1B2;
    }
</style>
