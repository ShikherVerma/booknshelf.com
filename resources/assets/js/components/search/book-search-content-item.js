Vue.component('app-book-search-content-item', {
    props: ['book'],

    mixins: [require('./book-search-bar')],

    data() {
        return {
            books: [],
        }
    },

    events: {
        searchChanged: function (query) {
            console.log("listening and responding " + query);
            this.$http.get('/books/search?q=' + query)
                .then(response => {
                    this.books = response.data;
                    console.log(this.books);

            });
        }
    },

});
