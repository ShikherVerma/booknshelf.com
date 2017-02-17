<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <book v-for="book in allBooks" :book="book" :user="user" :shelf="shelf" :likes="likes"
                      :saves="saves"></book>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['user', 'books', 'shelf', 'likes', 'saves'],

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
            Bus.$on('bookRemoved', this.getBooks);
        },
    }
</script>

<style lang="css">
</style>
