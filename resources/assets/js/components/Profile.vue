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
                    <a class="button is-white is-outlined" v-if="canEditOrDelete"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <i class="fa fa-sign-out"></i>
                        </span>
                        <span>Logout</span>
                    </a>
                </p>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['user'],

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
