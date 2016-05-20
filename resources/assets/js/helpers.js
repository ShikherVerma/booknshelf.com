var books = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('books'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: 'https://raw.githubusercontent.com/twitter/typeahead.js/gh-pages/data/countries.json',
  remote: {
    url: '../book/search?q=%QUERY',
    wildcard: '%QUERY'
  }
});

$('#remote .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 3
},
{
  name: 'google-api-books',
  display: 'books',
  source: books
});