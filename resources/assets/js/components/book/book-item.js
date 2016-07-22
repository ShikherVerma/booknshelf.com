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
            addSuccessPopover: false,
            saved: false,
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

        showSaveModal() {
            this.$broadcast('showSaveModal')
        }

    },

    events: {
        bookSaved() {
            this.saved = true;
        }
    },

});
