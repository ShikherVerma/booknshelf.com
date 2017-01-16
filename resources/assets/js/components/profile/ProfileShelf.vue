<template>

    <div class="card card-background2 card-raised grid-item-shelf" :style="style">
        <div class="content-shelf">
            <a :href="url">
                <h3 class="card-title">{{ shelf.name }}</h3>
                <p class="card-description">{{ shelf.books_count }} books</p>
            </a>
        </div>
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


.card-background2:after {
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
    background-color: rgba(32,96,101, 0.82);
    border-radius: 6px;
    color: black;
    font-weight: bold;
}

.card-title, .card-description {
    color: white;
}

.grid-item-shelf .content-shelf {
    height: 70%;
    width: 70%;
}

.content-shelf > a:hover {
    text-decoration: none;
    color: grey;
}

</style>
