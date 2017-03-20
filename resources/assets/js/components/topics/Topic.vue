<template>
    <div class="column is-one-third">
        <a :href="topicUrl">
            <div class="topic-card"
                :style="topicCoverImage">
                <div class="topic-container article">
                    <p class="title"><strong style="color: #FFF;">{{ topic.name }}</strong></p>
                    <nav class="level" style="justify-content:flex-start;">
                        <div class="level-left">
                            <p class="level-item">
                                <a class="button is-medium" :disabled="form.busy"
                                   :class="{ 'followed-button': isFollowedByAuthUser}"
                                   @click.stop.prevent="toggle()">
                                    <span v-if="!isFollowedByAuthUser">Follow</span>
                                    <span v-else>Following</span>
                                </a>
                            </p>
                            <span class="level-item" style="color: #FFF;">
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
                    </nav>
                </div>
            </div>
        </a>
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
        props: ['user', 'topic', 'userTopics'],

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
                // if user is not authenticated then show the login modal, otherwise login modal
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
            },

            topicPage() {
                window.location.href = '/topics/' + this.topic.slug;
            },

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
            topicUrl: function() {
                return '/topics/' + this.topic.slug;
            },
            topicCoverImage: function() {
                return `background-image: url(${this.topic.cover_photo})`;
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

<style type="text/css">
    .followed-button {
        background-color: #E95352;
        color: #ffffff;
    }

    .followed-button:hover {
        color: #ffffff;
        background-color: #1a9992;
    }

    .topic-card {
        height: 250px;
        background-position: center center;
        background-size: cover;
        cursor: pointer;
        position:relative;
    }

    .topic-card:after {
        z-index: 1;
        width: 100%;
        height: 100%;
        display: block;
        left: 0;
        top: 0;
        content: "";
        background-color: rgba(4, 4, 4, 0.36);
        border-radius: 6px;
        color: black;
        font-weight: bold;
    }

    .topic-container {
        padding: 20px;
        position: absolute;
    }

    .user-image {
        margin-left: -22px;
    }

    .img-circle {
        border-radius: 50%;
    }

    .user-images-div {
        margin-left: 10px;
    }

    .user-images-div:hover {
        opacity: 0.5;
    }

</style>
