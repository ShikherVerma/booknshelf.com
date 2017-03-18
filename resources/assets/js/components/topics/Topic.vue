<template>
    <div class="column is-one-third hvr-float" @click.stop.prevent="topicPage()">
        <div class="topic-card" :style="topicCoverImage" style="position: relative; padding: 0px; !important">
            <div class="topic-container article" style="position: absolute;">
                <p class="title"><strong style="color: #FFF;">{{ topic.name }}</strong></p>
                <nav class="level">
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
                </nav>
            </div>
        </div>
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

<style lang="css">
    .followed-button {
        background-color: #E95352;
        color: #ffffff;
    }

    .followed-button:hover {
        color: #ffffff;
    }

    .topic-card {
        height: 250px;
        background-position: center center;
        background-size: cover;
        cursor: pointer;
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
    }

</style>