<template>
    <div class="col-md-4" style="width: 300px;">
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
.card-background:after {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
    background-color: rgba(0, 0, 0, 0.56);
    border-radius: 6px;
}
.card-description{
    text-align: center;
    color: #FFFFFF;
    text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
}
</style>
