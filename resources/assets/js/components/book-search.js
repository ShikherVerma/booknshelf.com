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
        var books = new Bloodhound({
           // or Bloodhound.tokenizers.obj.whitespace('key_of_the_field'),
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: [],
          remote: {
            url: '/book/search?q=%QUERY',
            wildcard: '%QUERY'
          }
        });

        $('#typeahead').typeahead({
            minLength: 3,
            highlight: true,
            hint: true,
        },
        {
          name: 'book-suggestions',
          display: 'title',
          source: books,
          templates: {
              suggestion: function(hit) {
                  console.log(hit);
                  return (
                    '<div>' +
                        '<a href=/book/'+ hit.service_id +'>' +
                            '<h4 class="title">' + hit.title + '</h4>' +
                            '<h5 class="authors">' + hit.authors[0] + '</h5>' +
                        '</a>' +
                    '</div>'
                    );
              },
              highlight: function(h) {
                console.log(h);
              }
          }
        }).on('typeahead:select', function(e, suggestion) {
            this.query = suggestion.title;
        }.bind(this));

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
