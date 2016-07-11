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
            active: false,
            showModal: false,
            showNewBookshelfForm: false,
            addSuccessPopover: false,
            form: new AppForm({
                id: '',
                name: '',
            }),
        }
    },

    methods: {

        mouseOver() {
            if (this.active) return;
            this.active = !this.active;
        },

        showSavePopover() {
            this.addSuccessPopover = false;
            this.show = !this.show;
            // display a loading state here
            this.getUserBookshelves();
            this.loading = false;
        },

        // // get user's all bookshelves
        // getUserBookshelves() {
        //     this.$http.get('/user/shelves')
        //         .then(function(response) {
        //             console.log(response.data);
        //             this.shelves = response.data;
        //         });
        // },

        // // save the book in an existing bookshelf
        // storeBookToShelf(shelfId) {
        //     this.form.id = this.book.id;
        //     console.log(this.book.id);
        //     App.post(`/shelves/${shelfId}/books`, this.form)
        //         .then(function(response) {
        //             console.log(response.data);
        //         });
        // },

        // // save the books in a new bookshelf
        // storeBookToNewBookshelf() {
        //     // 2. Create a new bookshelf
        //     // 3. Call saveBookToBookshelf(bookId, shelfId)
        //     App.post('/shelves', this.form)
        //         .then(() => {
        //             this.form.name = '';
        //             // TODO: now we should add the book into the shelf
        //             this.show = false;
        //             this.addSuccessPopover = true;
        //         });
        //     // 1. Create a new bookshelf by name then save the book in that
        //     return [];
        // },

        showSaveModal() {
            this.$broadcast('showSaveModal')
        }

    },

    events: {
    },

});
