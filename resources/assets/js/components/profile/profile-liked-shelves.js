Vue.component('app-profile-liked-shelves', {
    props: [],

    data() {
        return {
            shelves: []
        }
    },

    events: {
        /**
         * Handle this component becoming the active tab.
         */
        appHashChanged: function (hash) {
            if (hash == 'likes' && this.shelves.length === 0) {
                this.getLikedShelves();
            }
        }
    },

    methods: {
        /**
         * Get the current API tokens for the user.
         */
        getLikedShelves() {
            this.$http.get('/user/shelves')
                    .then(function(response) {
                        this.shelves = response.data;
                    });
        },
    }

});
