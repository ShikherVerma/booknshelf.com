Vue.component('app-settings', {


    props: ['user'],


    /**
     * Load mixins for the component.
     */
    mixins: [require('./tab-state')],


    /**
     * Prepare the component.
     */
    mounted() {
        this.$nextTick(function () {
            this.usePushStateForTabs('.app-settings-tabs');
        })
    },
});
