Vue.component('app-book-item', {
    template: '#book-item',

    props: ['book'],

    ready() {
    },

    data() {
        return {
            shelves: [],
            show: false,
            loading: true,
            showNewBookshelfForm: false,
            addSuccessPopover: false,
            form: new AppForm({
                name: '',
            }),
        }
    },

    methods: {
        showSavePopover() {
            this.addSuccessPopover = false;
            this.show = !this.show;
            // display a loading state here
            this.getUserBookshelves();
            this.loading = false;
        },
        // get user's all bookshelves
        getUserBookshelves() {
            this.$http.get('/user/shelves')
                .then(function(response) {
                    console.log(response.data);
                    this.shelves = response.data;
                });
        },
        // save the book in an existing bookshelf
        saveBookToBookshelf() {
            console.log(this.$els.book);
            return true;
        },
        // save the books in a new bookshelf
        saveBookToNewBookshelf() {
            // 1. Create a book object with the given GOOGLE BOOK ID
            // 2. Create a new bookshelf
            // 3. Call saveBookToBookshelf(bookId, shelfId)
            App.post('/shelf/store', this.form)
                .then(() => {
                    // this.showAddSuccessMessage();
                    this.form.name = '';
                    // TODO: now we should add the book into the shelf
                    this.show = false;
                    this.addSuccessPopover = true;
                });
            // 1. Create a new bookshelf by name then save the book in that
            return [];
        },

        showAddSuccessMessage() {
            console.log('success');
            return true;
        }

    },

    events: {
    },

});
