@extends('layouts.app')

@section('content')
<div class="app-screen container">
    <div class="row">
        <!-- Tabs -->
        <div class="col-md-6">
            <div class="panel panel-default panel-flush">
                <input type="text" id="search-input" />
                <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
                <script src="//cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
                <script>
                  var client = algoliasearch('T0H494PKEG', '9fa1054e478ea1dc6499ec8584040039')
                  var index = client.initIndex('books');
                  autocomplete('#search-input', {hint: false}, [
                    {
                      source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
                      displayKey: 'name',
                      templates: {
                        suggestion: function(suggestion) {
                          return suggestion._highlightResult.name.value;
                        }
                      }
                    }
                  ]).on('autocomplete:selected', function(event, suggestion, dataset) {
                    console.log(suggestion, dataset);
                  });
                </script>
            </div>
        </div>

        <!-- Tab Panels -->
        <div class="col-md-6">
            <div id="remote">
              <input class="typeahead" type="text" placeholder="States of USA">
            </div>
        </div>
    </div>
</div>
@endsection
