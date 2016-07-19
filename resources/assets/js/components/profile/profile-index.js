Vue.component('app-profile-index', {
    props: ['user'],

    created() {
        this.user = JSON.parse(this.user);
    },

    /**
     * Load mixins for the component.
     */
    mixins: [require('../tab-state')],

    /**
     * Prepare the component.
     */
    ready() {
        this.usePushStateForTabs('.profile-index-tabs');
    },

});
