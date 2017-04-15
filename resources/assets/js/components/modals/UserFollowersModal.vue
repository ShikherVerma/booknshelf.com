<template>
    <div class="modal is-active">
        <div class="modal-background" @click="$emit('close')"></div>
        <div class="modal-card user-followers-modal-content">
            <header class="modal-card-head" style="padding: 12px;">
                <p class="modal-card-title" style="font-size: 1.2rem;">FOLLOWERS {{ followers.length }}</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <div v-if="!loading && !followers.length" class="columns">
                    <div class="column">
                        <div class="message is-primary">
                          <div class="message-body">
                              <p class="title has-text-centered">
                                  <span class="icon is-large">
                                    <i class="fa fa-users"></i>
                                  </span>
                              </p>
                              <h3 class="title has-text-centered" style="color: dimgray;">
                                  You don't have any followers yet.
                              </h3>
                              <p class="subtitle has-text-centered" style="color: dimgray;">
                                People will start following you if you have a better looking profile with shelves and books.
                                Start adding more books to your shelves so people can discover them!
                              </p>
                          </div>
                        </div>
                    </div>
                </div>
                <article v-for="follower in followers"class="media">
                    <figure class="media-left">
                        <p class="image is-48x48">
                            <a :href="'/@' + follower.username">
                                <img :src="follower.avatar">
                            </a>
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p class="subtitle" style="margin-bottom: 3px;">
                                <a :href="'/@' + follower.username">
                                    <strong class="follower-title">{{ follower.name }}</strong>
                                </a>
                            </p>
                            <h6 class="subtitle is-6" style="color: #6b6666;">{{ follower.followers_count }} followers</h6>
                        </div>
                    </div>
                    <div class="media-right">
                        <!-- You can't follow yourself -->
                        <a v-if="!isFollowerYou(follower.pivot.follower_id)" class="button is-primary is-outlined" :disabled="form.busy"
                            :class="{ 'user-followed-button-green': isFollowedByAuthUser(follower.pivot.follower_id)}"
                            @click.stop.prevent="toggle(follower.pivot.follower_id)">
                            <span v-if="!isFollowedByAuthUser(follower.pivot.follower_id)">Follow</span>
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
                followers: []
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
            this.$http.get(`/users/${this.user.id}/followers`)
                .then(function(response) {
                    this.followers = response.data;
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
    .follower-title:hover {
        color: #00D1B2;
    }
</style>
