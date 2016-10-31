Vue.component('app-book-item-save-modal', {

    props: ['book'],

    data() {
        return {
            show: false,
            shelves: [],
            loading: true,
            showNewShelfForm: false,
            success: false,
            form: new AppForm({
                id: '',
            }),
        }
    },

    methods: {
        // get user's all bookshelves
        getUserBookshelves() {
            this.$http.get('/user/shelves')
                .then(function(response) {
                    this.loading = false;
                    this.shelves = response.data;
                });
        },

        storeBookToShelf(shelfId) {
            this.form.id = this.book.id;
            App.post(`/shelves/${shelfId}/books`, this.form)
                .then(() => {
                    this.success = true;
                    this.$dispatch('bookSaved');
                });
        },

        storeBookToNewBookshelf() {
            App.post('/shelves', this.form)
                .then((response) => {
                    var shelfId = response.id;
                    this.form.name = '';
                    // add the book to the new shelf
                    this.storeBookToShelf(shelfId);
                    this.success = true;
                });
        },

        close() {
            this.show = false;
            this.success = false;
            this.showNewShelfForm = false;
            this.form.errors.forget();
        }

    },

    events: {
        showSaveModal() {
            this.show = true;
            this.loading = true;
            this.getUserBookshelves();
        }
    },

    ready: function () {
        document.addEventListener("keydown", (e) => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    }
});