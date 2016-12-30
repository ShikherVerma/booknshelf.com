<template>
    <div class="container m-y-md shelf-books">
        <div class="row">
            <shelf-book v-for="book in allBooks" :book="book" :user="user" :shelf="shelf"></shelf-book>
        </div>
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

<style>
</style>
