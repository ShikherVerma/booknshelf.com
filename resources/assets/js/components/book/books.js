Vue.component('app-books', {
    template: '#books',

    props: ['books'],

    data: function() {
        return {
            books: [],
        }
    },

    created() {
        this.books = JSON.parse(this.books);
    }
});
