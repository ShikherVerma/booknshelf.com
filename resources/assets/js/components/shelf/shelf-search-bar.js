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
        var shelves = this.client.initIndex('shelves_production');
        var users = this.client.initIndex('users_production');

        var templateDropdown = Hogan.compile(
            '<div class="left-container">' +
            '<div class="aa-dataset-user"></div>' +
            '</div>' +
            '<div class="right-container">' +
            '<div class="aa-dataset-shelf"></div>' +
            '</div>');

        autocomplete('#algolia-search', {
            hint: true,
            minLength: 2,
            templates: {
                dropdownMenu: templateDropdown.render(),
                footer: '<div class="algolia-logo">Powered by <img height="20px" width="70px" src="https://www.algolia.com/assets/algolia128x40.png" /></div>'
            }
        },
            [
                {
                    source: autocomplete.sources.hits(users, {hitsPerPage: 5}),
                    templates: {
                        header: '<div class="category">Users</div>',
                        suggestion: function(suggestion) {
                            return '<h5>' + suggestion._highlightResult.name.value + '</h5>'
                        }
                    },
                    displayKey: 'name',
                    name: 'user'
                },
                {
                    source: autocomplete.sources.hits(shelves, {hitsPerPage: 5}),
                    templates: {
                        header: '<div class="category">Shelves</div>',
                        suggestion: function(suggestion) {
                          return '<h5>' + suggestion._highlightResult.name.value  + '</h5>';
                        }
                    },
                    displayKey: 'name',
                    name: 'shelf',
                }
            ]).on('autocomplete:selected', function(event, suggestion, dataset) {
                console.log(suggestion, dataset);
                switch (dataset) {
                    case 'user':
                        window.location = '/@' + suggestion.username;
                        break;
                    case 'shelf':
                        window.location = '/@' + suggestion.user.username + '/shelves/' + suggestion.slug;
                        break;
                }
            });
    },

    methods: {
        // Currenrly not used.
        search: function() {
            this.client = algoliasearch('T0H494PKEG', 'dcdaf55ad36be23423eb00e8faa8089d');
            this.index = this.client.initIndex('shelves_production');
            if (this.query.length === 0) {
                this.shelves = [];
            }
            if (this.query.length < 3) {
                return;
            }

            this.index.search(this.query, function(error, results) {
                this.shelves = results.hits;
            }.bind(this));
        }
    }

});
