<template>
    <div class="col-md-4 hvr-grow" style="width: 300px;">
        <a :href="url">
            <div class="card card-raised card-background2" :style="style">
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
.card-background2 {
    background-position: center center;
    background-size: cover;
    text-align: center;
}


.card-background2 .content {
    position: relative;
    z-index: 2;
    min-height: 280px;
    padding-top: 40px;
    padding-bottom: 40px;
    max-width: 440px;
    margin: 0 auto;
}

.card-background2:after {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
    background-color: rgba(111, 172, 201, 0.92);
    border-radius: 6px;
    color: black;
    font-weight: bold;
}

.card-title, .card-description {
    color: white;
}

</style>
