<template>
    <section class="hero is-primary is-bold">

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container">
                <figure class="image is-128x128 is-clearfix">
                    <img :src="user.avatar">
                </figure>
                <h1 class="title">
                    {{ user.name }}
                </h1>
                <h2 class="subtitle">
                    {{ user.about }}
                </h2>
                <p class="control">
                    <a class="button is-primary" v-if="canEditOrDelete" href="/settings">
                        <span class="icon">
                            <i class="fa fa-cog"></i>
                        </span>
                        <span>Settings</span>
                    </a>
                    <a class="button is-link" v-if="canEditOrDelete"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </p>
            </div>
        </div>
        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <nav class="tabs">
                <div class="container">
                    <ul>
                        <li class="is-active"><a>{{ shelves.length }} Bookshelves</a></li>
                        <li><a>{{ likes.length }} Likes</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['user', 'shelves', 'likes'],

        mounted() {
            console.log('Component ready.')
        },

         computed: {
            canEditOrDelete() {
                return App.userId === this.user.id;
            }
        },
    }
</script>

<style lang="css">
</style>
