<template>
    <div class="column is-3">
        <a :href="url" v-if="shelf.books_count < 1">
            <div class="box hvr-float tile profile-shelf-tile">
                <div class="tile is-4 is-vertical is-parent">
                    <div class="tile is-child box"></div>
                    <div class="tile is-child box"></div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child box"></div>
                </div>
            </div>
        </a>
        <a :href="url" v-else>
            <div class="box shelf-item hvr-float" :style="style"></div>
        </a>
        <a :href="url">
            <h2 class="title profile-shelf-title">
                <strong>{{ shelf.name }}</strong>
            </h2>
        </a>
        <p class="subtitle">{{ shelf.books_count }} books</p>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelf'],


        mounted() {},

        computed: {
            url: function () {
                return '/@' + this.user.username + '/shelves/' + this.shelf.slug
            },
            style: function() {
                var coverImageUrl = "https://booknshelf.imgix.net/shelf-covers/" + this.shelf.cover + "?fit=crop&h=250&w=250&q=40";
                return `background-image: url(${coverImageUrl})`;
            }
        }
    }
</script>

<style lang="css">
    .profile-shelf-tile {
        width:250px;
        height:250px;
    }
    .profile-shelf-title {
        margin-top:15px;
    }
    .shelf-item {
        height: 250px;
        width: 250px;
    }
</style>

