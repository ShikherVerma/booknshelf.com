Vue.component('app-navbar', {
    props: [
        'user', 'hasUnreadNotifications', 'hasUnreadAnnouncements'
    ],


    methods: {
         /**
          * Show the user's notifications.
          */
         showNotifications() {
            this.$dispatch('showNotifications');
        },

    }
});
