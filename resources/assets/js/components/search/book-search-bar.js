Vue.component('app-book-search-bar', {

    props: [],

    /**
     * The component's data.
     */
    data() {
        return {
            query: '',
        }
    },

    methods: {
        search: function(e) {
            this.$broadcast('searchChanged', this.query);
            e.preventDefault();
        }
    }

});
