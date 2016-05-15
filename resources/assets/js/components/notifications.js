Vue.component('app-notifications', {
    props: ['notifications', 'loadingNotifications'],

    /**
     * The component's data.
     */
    data() {
        return {
            showingNotifications: true,
        }
    },


    methods: {
        /**
         * Show the user notifications.
         */
        showNotifications() {
            this.showingNotifications = true;
        },
    },


    computed: {
        /**
         * Get the active notifications or announcements.
         */
        activeNotifications() {
            if ( ! this.notifications) {
                return [];
            }

            if (this.showingNotifications) {
                return this.notifications.notifications;
            }
        },


        /**
         * Determine if the user has any notifications.
         */
        hasNotifications() {
            return this.notifications && this.notifications.notifications.length > 0;
        },
    }
});
