Vue.component('app-shelf', {
    template: '#shelf',

    props: ['shelf', 'books'],

    created() {
        this.books = JSON.parse(this.books);
        this.shelf = JSON.parse(this.shelf);
    },

    methods: {
        getBooks() {
            var shelfId = this.shelf.id;
            this.$http.get(`/shelves/${shelfId}/books`)
                .then(function(response) {
                    this.books = response.data;
                });
        },
    },

    events: {
        updateShelf() {
            this.getBooks();
        },
        showPleaseLoginModal() {
            this.$broadcast('showPleaseLoginModal');
        }
    },

});
