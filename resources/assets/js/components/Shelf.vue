<template>
    <div class="profile-header shelf-page-header text-center" style="background-image: url('/img/backgrounds/shelf-page-background.jpg');">
        <div class="container">
            <div class="container-inner">
                <h2 class="profile-header-user">{{ shelf.name }}</h2>
                <p v-if="shelf.description" class="profile-header-bio">
                    {{ shelf.description}}
                </p>
                <h6 class="profile text-muted" :href="profileUrl">
                    <img class="img-circle small-profile-photo" :src="user.avatar">
                    {{ user.name }}
                </h6>
            </div>
        </div>

        <nav class="profile-header-nav">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#">{{ books.length }} Books</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelf', 'books'],

        computed: {
            profileUrl: function () {
                return '/@' + this.user.username;
            }
        }
    }
</script>

<style lang="sass">
</style>
