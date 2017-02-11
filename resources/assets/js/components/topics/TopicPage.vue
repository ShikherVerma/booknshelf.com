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
                            <div class="level topic-follow-section">
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
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column">
                            <div id="#social">
                                <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fbooknshelf.com&layout=button&size=small&mobile_iframe=true&appId=1899203000306326&width=59&height=20"
                                        width="59" height="20" style="border:none;overflow:hidden"
                                        scrolling="no"
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
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="columns is-multiline">
                    <book v-for="book in books" :book="book" :user="user" :likes="likes" :saves="saves"></book>
                </div>
            </div>
        </section>
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
                followersCount: this.topic.followers_count
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
    }

    .followed-button:hover {
        color: #ffffff;
    }

    .follow-button {
        color: #404042 !important;
    }
</style>
