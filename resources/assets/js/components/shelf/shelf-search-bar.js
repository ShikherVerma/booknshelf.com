Vue.component('app-shelf-search-bar', {

    props: [],

    data() {
        return {
            query: '',
            shelves: []
        }
    },

    ready: function() {
        this.client = algoliasearch('T0H494PKEG', 'dcdaf55ad36be23423eb00e8faa8089d');
        this.index = this.client.initIndex('shelves_local');
    },

    methods: {
        search: function() {
            if (this.query.length < 3) return;

            this.index.search(this.query, function(error, results) {
                this.shelves = results.hits;
            }.bind(this));
        }
    }

});
