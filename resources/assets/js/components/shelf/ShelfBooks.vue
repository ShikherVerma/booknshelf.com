<template>
    <section class="section">
        <div class="container">
            <div v-if="books.length < 1" class="column is-half">
                <div class="message is-primary">
                  <div class="message-body">
                      <p class="title has-text-centered">
                          <span class="icon is-large">
                            <i class="fa fa-book"></i>
                          </span>
                      </p>
                      <h3 class="title has-text-centered" style="color: dimgray;">
                          You haven't added any books to this shelf.
                      </h3>
                      <p class="subtitle has-text-centered" style="color: dimgray;">
                          Search for books in the search bar at the top and add them to your shelves.
                      </p>
                  </div>
                </div>
            </div>
            <div v-else class="columns is-multiline">
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
