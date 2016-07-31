Vue.component('app-profile-shelf-item', {

    props: ['shelf', 'user'],

    methods: {

        canEditOrDelete() {
            return App.userId === this.user.id;
        },

        showDeleteShelfModal() {
            this.$dispatch('showDeleteShelfModal', this.shelf);
        },

        showEditShelfModal() {
            this.$dispatch('showEditShelfModal', this.shelf);
        }

    },

    computed: {
        url: function() {
            return '/@' + this.user.username + '/shelves/' + this.shelf.slug
        }
    }

});
