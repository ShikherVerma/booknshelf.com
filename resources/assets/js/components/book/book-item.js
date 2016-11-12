Vue.component('app-book-item', {
    template: '#book-item',

    props: ['book'],

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
            // if user is authenticated then show the save modal, otherwise login modal
            console.log(App.userId);
            if (App.userId) {
                this.$broadcast('showSaveModal')
            } else {
                this.$broadcast('showPleaseLoginModal');
            }
        }

    },

    events: {
        bookSaved() {
            this.saved = true;
        }
    },

});
