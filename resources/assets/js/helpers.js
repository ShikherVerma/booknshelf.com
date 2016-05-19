// // constructs the suggestion engine
// var states = new Bloodhound({
//   datumTokenizer: Bloodhound.tokenizers.whitespace,
//   queryTokenizer: Bloodhound.tokenizers.whitespace,
//   // `states` is an array of state names defined in "The Basics"
//   local: ['jersey city', 'something', 'book', 'amazing', 'awesome']
// });

// $('#bloodhound .typeahead').typeahead({
//   hint: true,
//   highlight: true,
//   minLength: 1
// },
// {
//   name: 'states',
//   source: states
// });


var bestPictures = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  local: ['jersey city', 'something', 'book', 'amazing', 'awesome'],
  remote: {
    url: '../book/search?q=%QUERY',
    wildcard: '%QUERY'
  }
});

$('#remote .typeahead').typeahead(null, {
  name: 'best-pictures',
  display: 'value',
  source: bestPictures
});