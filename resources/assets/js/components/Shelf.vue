<template>
    <section class="hero is-small is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ shelf.name }}
                </h1>
                <h2 class="subtitle" v-if="shelf.description">
                    {{ shelf.description}}
                </h2>
                <h2>
                    <div class="level">
                        <div class="level-left">
                            <p class="level-item">
                                <figure class="image is-48x48">
                                    <img :src="avatarUrl" class="shelf-profile-pic">
                                </figure>
                            </p>
                            <p>
                                <a :href="profileUrl">
                                    <strong>{{ user.name }}</strong>
                            </a>
                            </p>
                        </div>
                        <div class="level-right">
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
                            <div v-if="canEditOrDelete" class="level-item">
                                <a class="button is-primary is-inverted is-outlined" @click="showEditShelfModal = true">
                                    <span class="icon">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </h2>
            </div>
        </div>
        <edit-shelf-modal
                v-if="showEditShelfModal"
                :shelf="shelf"
                :user="user"
                @close="showEditShelfModal = false"
        ></edit-shelf-modal>
    </section>
</template>

<script>
    export default {
        props: ['user', 'shelf'],

        data() {
            return {
                showEditShelfModal: false
            }
        },

        computed: {
            profileUrl: function () {
                return '/@' + this.user.username;
            },

            avatarUrl() {
                return "https://booknshelf.imgix.net/profiles/" + this.user.avatar + "?auto=format&auto=compress&codec=mozjpeg&cs=strip&w=48&h=48&fit=crop";
            },

            canEditOrDelete() {
                return App.userId === this.user.id;
            },
            twitterShareUrl: function() {
                return "http://twitter.com/intent/tweet?status=" +
                this.shelf.name + ": " + this.shelf.description + " by @" + this.user.username
                + " " + window.location.href;
            },
            facebookShareUrl: function() {
                return "http://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "&title=" +
                 this.shelf.name + " by " + this.user.name;
            }
        },
    }
</script>

<style lang="css">
    .shelf-profile-pic {
        border-radius: 50%;
    }
</style>
