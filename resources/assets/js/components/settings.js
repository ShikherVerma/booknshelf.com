Vue.component('spark-settings', {

    props: ['user', 'teams'],


    /**
     * Load mixins for the component.
     */
    mixins: [require('./tab-state')],


    /**
     * The component's data.
     */
    data() {
        return {
            billableType: 'user'
        };
    },


    /**
     * Prepare the component.
     */
    ready() {
        this.usePushStateForTabs('.spark-settings-tabs');
    },
});
