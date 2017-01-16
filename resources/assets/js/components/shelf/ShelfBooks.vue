<template>
    <div class="home-container">
        <!--<div class="card card-background grid-item-book">-->
            <!--<div>-->
                  <!--<i class="fa fa-plus" ></i> Create a new bookshelf-->
            <!--</div>-->
        <!--</div>-->
        <shelf-book v-for="book in allBooks" :book="book" :user="user" :shelf="shelf"></shelf-book>
    </div>
</template>

<script>
    export default {
        props: ['user', 'books', 'shelf'],

        data() {
            return {
                'allBooks': this.books
            }
        },

        methods: {
            getBooks() {
                var shelfId = this.shelf.id;
                this.$http.get(`/shelves/${shelfId}/books`)
                    .then(function(response) {
                        this.allBooks = response.data;
                    });
            },
        },

        created: function () {
            this.$eventHub.$on('bookRemoved', this.getBooks);
        },
    }
</script>

<style lang="css">
</style>
