<app-book-search-bar inline-template>
    <form class="navbar-form"  role="form" method="GET" action="{{ url('/books/search') }}">
        <div class="input-group">
          <input id="book-search" type="text" value="{{ old('q') }}" class="form-control"
            placeholder="Search for great books ..." name="q">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </span>
        </div>
    </form>
</app-book-search-bar>