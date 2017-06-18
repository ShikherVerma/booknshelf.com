<template>
    <div>
        <section class="hero is-small is-primary is-bold">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-2 topic-page-image">
                            <figure class="image is-128x128">
                                <img :src="topicCoverPhoto">
                            </figure>
                        </div>
                        <div class="column is-half">
                            <h1 class="title">
                                <strong>{{ topic.name }}</strong>
                            </h1>
                            <h2 class="subtitle" v-if="topic.description">
                                {{ topic.description}}
                            </h2>
                            <div class="level topic-follow-section" style="justify-content:flex-start;">
                                <div class="level-left">
                                    <p class="level-item">
                                        <a class="button is-medium" :disabled="form.busy"
                                           :class="[ isFollowedByAuthUser ? 'followed-button' : 'follow-button' ]"
                                           @click.stop.prevent="toggle()">
                                            <span v-if="!isFollowedByAuthUser">Follow</span>
                                            <span v-else>Following</span>
                                        </a>
                                    </p>
                                    <span class="level-item">
                                         {{ followersCount }} followers
                                     </span>
                                </div>
                                <div @click.stop.prevent="showTopicFollowersModal = true" class="level-right has-text-left user-images-div">
                                    <span v-if="topic.followers[0]" class="level-item">
                                        <figure class="image is-32x32">
                                          <img class="img-circle" :src="topic.followers[0].avatar">
                                        </figure>
                                    </span>
                                    <span v-if="topic.followers[1]" class="level-item user-image">
                                        <figure class="image is-32x32">
                                          <img class="img-circle" :src="topic.followers[1].avatar">
                                        </figure>
                                    </span>
                                    <span v-if="topic.followers[2]" class="level-item user-image">
                                        <figure class="image is-32x32">
                                          <img class="img-circle" :src="topic.followers[2].avatar">
                                        </figure>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column">
                            <div id="#social">
                                <a class="button is-medium twitter-tweet-button"
                                   :href="twitterShareUrl" target="_blank">
                                  <span class="icon">
                                    <i class="fa fa-twitter"></i>
                                  </span>
                                </a>
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
        </section>
        <section class="section">
            <div class="container">
                <div class="columns is-multiline">
                    <book v-for="book in books" :book="book" :user="user" :likes="likes" :saves="saves"></book>
                </div>
            </div>
        </section>
        <topic-followers-modal
            :user="user"
            v-if="showTopicFollowersModal"
            @close="showTopicFollowersModal = false"
            :followers="topic.followers">
        </topic-followers-modal>
    </div>
</template>

<script>
    export default {
        props: ['topic', 'books', 'user', 'userTopics', 'likes', 'saves'],

        data() {
            return {
                form: new AppForm({
                    id: '',
                }),
                showTopicFollowersModal: false,
                followersCount: this.topic.followers.length
            }
        },

        methods: {

            toggle() {
                this.form.startProcessing();
                if(this.isFollowedByAuthUser) {
                    this.unfollow()
                } else {
                    this.follow()
                }
                this.form.finishProcessing();
            },

            follow() {
                // if user is authenticated then show the login modal, otherwise login modal
                if (App.userId) {
                    App.post(`/topics/follow`, this.form)
                        .then(() => {
                            // update the user and also reload all user topics
                            Bus.$emit('loadUserTopics');
                            this.followersCount +=1
                        }).catch(function(reason) {
                            console.log(reason);
                        })
                } else {
                    Bus.$emit('showPleaseLoginModal');
                }
            },

            unfollow() {
                // if user is authenticated then show the login modal, otherwise login modal
                if (App.userId) {
                    App.post(`/topics/unfollow`, this.form)
                        .then(() => {
                            Bus.$emit('loadUserTopics');
                            this.followersCount -=1
                        }).catch(function(reason) {
                            console.log(reason);
                        })
                } else {
                    Bus.$emit('showPleaseLoginModal');
                }
            }
        },

        computed: {
            topicCoverPhoto: function () {
                if (this.topic.cover_photo) {
                    return this.topic.cover_photo;
                } else {
                    return '';
                }
            },
            isFollowedByAuthUser: function () {
                return (this.userTopics.indexOf(this.topic.id) != -1)
            },
            topicFollowText: function() {
                 return isFollowedByAuthUser ? "Following" : "Follow";
            },
            twitterShareUrl: function() {
                return "http://twitter.com/intent/tweet?status=" +
                "Check out the best books on " + this.topic.name + " @booknshelf. "
                + window.location.href;
            },
            facebookShareUrl: function() {
                return "http://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "&title=" +
                 "The best books on " +
                 this.topic.name + " at Booknshelf."
            }
        },

        /**
        * Bootstrap the component.
        */
        mounted() {
            this.form.id = this.topic.id;
        },
    }
</script>

<style lang="css">
    .topic-page-image {
        width: 140px !important;
    }

    .followed-button {
        background-color: hsla(171, 100%, 36%, 1);
        color: #ffffff;
        border: none;
    }

    .followed-button:hover {
        color: #ffffff;
    }

    .follow-button {
        color: #404042 !important;
    }
    .user-images-div {
        cursor: pointer;
    }
    .user-images-div:hover {
        opacity: 0.5;
    }
</style>
