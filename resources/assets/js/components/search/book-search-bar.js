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
            console.log("broadcasting " + this.query);
            this.$broadcast('searchChanged', this.query);
            e.preventDefault();
        }
    }

});
