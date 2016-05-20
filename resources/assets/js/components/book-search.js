Vue.component('app-book-search', {

    props: ['user'],

    /**
     * The component's data.
     */
    data: function()   {
        return {
            query: '',
            books: [],
        };
    },


    /**
     * Bootstrap the component.
     */
    ready: function() {
        // $('#typeahead').typeahead(null, {
        //     source: this.books
        // });
        var bestPictures = new Bloodhound({
           // or Bloodhound.tokenizers.obj.whitespace('key_of_the_field'),
          datumTokenizer: Bloodhound.tokenizers.whitespace,
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: [],
          remote: {
            url: '/book/search?q=%QUERY',
            wildcard: '%QUERY'
          }
        });

        $('#typeahead').typeahead({
            minLength: 3,
            highlight: true
        },
        {
          name: 'best-pictures',
          // display: 'value',
          source: bestPictures
        });
    },


    methods: {
        search: function() {
            if (this.query.length < 3) return;
            this.$http.get('/book/search?q=' + this.query)
                .then(response => {
                    console.log(response.data)
                    this.books = response.data;
            });
        }
    }

});
