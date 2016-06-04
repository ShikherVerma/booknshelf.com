Vue.component('app-profile-index', {
    props: ['user'],

    /**
     * Load mixins for the component.
     */
    mixins: [require('../tab-state')],

    /**
     * The component's data.
     */
    data() {
        return {
            shelves: []
        };
    },


    /**
     * Prepare the component.
     */
    ready() {
        this.usePushStateForTabs('.profile-index-tabs');
        this.getShelves();
    },


    events: {
        /**
         * Broadcast that child components should update their shelves.
         */
        updateShelves() {
            this.getShelves();
        }
    },


    methods: {
        /**
         * Get the current API tokens for the user.
         */
        getShelves() {
            this.$http.get('/user/shelves')
                    .then(function(response) {
                        console.log(response.data);
                        this.shelves = response.data;
                    });
        },
    }
});
