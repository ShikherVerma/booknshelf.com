<template>
    <div class="column is-half">
        <article class="media hvr-glow" style="padding: 10px;" @click.stop.prevent="topicPage()">
            <figure class="media-left">
                <p class="image is-128x128">
                    <img :src="topicCoverPhoto">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <a :href="topicUrl">
                        <h1 class="subtitle is-4 topic-name">{{ topic.name }}</h1>
                    </a>
                </div>
                <nav class="level">
                    <div class="level-left">
                        <p class="level-item">
                            <a class="button is-medium" :disabled="form.busy" :class="{ 'followed-button': isFollowedByAuthUser}"
                               @click.stop.prevent="toggle()">
                                <span v-if="!isFollowedByAuthUser">Follow</span>
                                <span v-else>Following</span>
                            </a>
                        </p>
                        <span class="level-item">
                            {{ followersCount }} followers
                        </span>
                    </div>
                </nav>
            </div>
            <div class="media-right">
            </div>
        </article>
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

</style>