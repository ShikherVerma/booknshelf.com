<template>
    <div class="column is-3">
        <a :href="url">
            <div class="box shelf-item hvr-float" :style="style"></div>
        </a>
        <a :href="url">
            <h2 class="title">{{ shelf.name }}</h2>
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
                return `background-image: url('${this.shelfCover}')`;
            },

            shelfCover: function() {
                if (this.shelf.cover) {
                    return this.shelf.cover
                } else {
                    return '';
                }
            }
        }
    }
</script>

<style lang="css">
    .box {
        padding: 0px;
    }
    .shelf-item {
        height: 250px;
    }
    .shelf-item:after {
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
</style>

