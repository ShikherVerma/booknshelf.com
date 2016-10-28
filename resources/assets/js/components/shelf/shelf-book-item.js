Vue.component('app-shelf-book-item', {
    template: '#shelf-book-item',

    props: ['shelf', 'book', 'user'],

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

        onOwnProfile() {
            return App.userId === this.user.id;
        },

        showSaveModal() {
            // if user is authenticated then show the save modal, otherwise login modal
            if (App.userId) {
                this.$broadcast('showSaveModal')
            } else {
                this.$dispatch('showPleaseLoginModal');
            }
        },

        alert(id) {
            console.log(id);
        }
    }

});
