<template>
    <div class="profile-header text-center" style="background-image: url('/img/backgrounds/tpv9dh822va-stefan-stefancik.jpg');">
        <div class="container">
            <div class="container-inner">
                <img class="img-circle media-object" :src="user.avatar">
                <h3 class="profile-header-user">{{ user.name }}</h3>
                <p class="profile-header-bio">
                    {{ user.about }}
                </p>
            </div>
        </div>

        <nav class="profile-header-nav">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#">{{ shelves.length }} Bookshelves</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelves'],

        mounted() {
            console.log('Component ready.')
        }
    }
</script>

<style lang="sass">
</style>
