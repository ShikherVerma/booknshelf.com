<app-book-search :user="user" inline-template>
    <form class="navbar-form" role="form" method="GET" action="{{ url('/book/search') }}">
        <div class="input-group">
          <input id="nottypeahead" type="text" class="form-control input-lg" 
            placeholder="Search for books..." name="q" style="width: 500px;">
          <span class="input-group-btn">
            <button class="btn btn-default btn-lg" type="submit">Search</button>
          </span>
        </div><!-- /input-group -->
    </form>
</app-book-search>
