Vue.component('app-navbar', {
    props: [
        'user', 'hasUnreadNotifications'
    ],


    methods: {
         /**
          * Show the user's notifications.
          */
        showNotifications() {
            this.$dispatch('showNotifications');
        },

        /**
         * Show the create new shelf modal
         */
        showCreateShelfModal() {
            this.$dispatch('showCreateShelfModal');
        },

    }
});
