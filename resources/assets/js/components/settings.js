Vue.component('app-settings', {


    props: ['user'],


    /**
     * Load mixins for the component.
     */
    mixins: [require('./tab-state')],


    /**
     * Prepare the component.
     */
    ready() {
        this.usePushStateForTabs('.app-settings-tabs');
    },
});
