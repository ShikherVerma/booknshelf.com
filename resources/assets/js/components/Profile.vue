<template>
    <div>
        <section class="hero is-primary">
            <!-- Hero content: will be in the middle -->
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-2">
                            <figure class="image is-128x128 is-clearfix">
                                <img class="circle-avatar" :src="avatarUrl">
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
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        computed: {
            avatarUrl() {
                return "https://booknshelf.imgix.net/profiles/" + this.user.avatar + "?auto=format&auto=compress&codec=mozjpeg&cs=strip&w=128&h=128&fit=crop";
            },
        },
    }
</script>

<style lang="css">
    .circle-avatar {
        border-radius: 50%;
    }
</style>
