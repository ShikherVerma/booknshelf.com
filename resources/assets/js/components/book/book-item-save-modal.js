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
                name: '',
            }),
            // book: null,
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

        // save the book to an existing bookshelf
        storeBookToShelf(shelfId, shelfName) {
            this.form.id = this.book.id;
            console.log(this.book.id);
            App.post(`/shelves/${shelfId}/books`, this.form)
                .then(() => {
                    this.success();
                });
        },

        // save the books in a new bookshelf
        storeBookToNewBookshelf() {
            // 2. Create a new bookshelf
            // 3. Call saveBookToBookshelf(bookId, shelfId)
            App.post('/shelves', this.form)
                .then(() => {
                    this.form.name = '';
                    // TODO: now we should add the book into the shelf
                    this.show = false;
                    this.addSuccessPopover = true;
                });
            // 1. Create a new bookshelf by name then save the book in that
            return [];
        },

        success() {
            this.success = true;
        }
    },

    events: {
        showSaveModal() {
            this.show = true;
            this.loading = true;
            this.getUserBookshelves();
            console.log(this.book.title);
            console.log(this.book.id);
        }
    },

})