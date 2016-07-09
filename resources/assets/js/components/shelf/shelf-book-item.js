Vue.component('app-shelf-book-item', {
    template: '#shelf-book-item',

    props: ['shelf', 'book'],

    data() {
        return {
            form: new AppForm({
                id: '',
            }),
        }
    },

    methods: {
        // remove the book from the bookshelf
        removeBookFromShelf() {
            this.form.id = this.book.id;
            var shelfId = this.shelf.id;
            App.delete(`/shelves/${shelfId}/books`, this.form)
                .then(() =>{
                    this.$dispatch('updateShelf');
                });
        },
    }

});
