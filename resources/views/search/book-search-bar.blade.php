<app-book-search-bar inline-template>
    <form class="navbar-form"  role="form" method="GET" action="{{ url('/books/search') }}">
        <div class="input-group">
          <input id="book-search" type="text" class="form-control"
            placeholder="Search for books..." name="q">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>
        </div>
    </form>
</app-book-search-bar>