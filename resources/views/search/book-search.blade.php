<app-book-search :user="user" inline-template>
    <form class="navbar-form" role="form" method="GET" action="{{ url('/book/search') }}">
        <div class="input-group">
          <input id="book-search" type="text" class="form-control"
            placeholder="Search for books..." name="q">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>
        </div><!-- /input-group -->
    </form>
</app-book-search>