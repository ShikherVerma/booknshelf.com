<template>
    <div class="col-md-4">
        <a :href="url">
            <div class="card card-raised card-background" :style="style">
                <div class="content">
                    <h3 class="card-title">{{ shelf.name }}</h3>
                    <p class="card-description">{{ shelf.books_count }} books</p>
                </div>
            </div>
        </a>
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
                return `background-image: url('${this.shelf.cover}')`;
            }
        }
    }
</script>

<style>
</style>
