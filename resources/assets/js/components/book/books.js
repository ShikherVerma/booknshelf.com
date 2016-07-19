Vue.component('app-books', {
    template: '#books',

    props: ['books'],

    created() {
        this.books = JSON.parse(this.books);
    }
});
