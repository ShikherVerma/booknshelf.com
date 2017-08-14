<template>
    <div class="modal is-active">
        <div class="modal-background" @click="$emit('close')"></div>
        <div class="modal-card user-followers-modal-content">
            <header class="modal-card-head" style="padding: 12px;">
                <p class="modal-card-title" style="font-size: 1.2rem;">FOLLOWERS {{ followers.length }}</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <article v-for="follower in followers"class="media">
                    <figure class="media-left">
                        <p class="image is-48x48">
                            <a :href="'/@' + follower.username">
                                <img :src="getFollowerAvatarUrl(follower.avatar)">
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
                            <h6 class="subtitle is-6">
                                {{ follower.about }}
                            </h6>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'followers'],

        data() {
            return {
                showTopicFollowersModal: false,
            }
        },

        methods: {
            getFollowerAvatarUrl(avatar) {
                return "https://booknshelf.imgix.net/profiles/" + avatar + "?auto=format&auto=compress&codec=mozjpeg&cs=strip&w=48&h=48&fit=crop";
            }
        },

        mounted() {
            mixpanel.track("Saw Modal", {"modal": "Topic Followers"});
        },
    }
</script>

<style type="text/css">
</style>
