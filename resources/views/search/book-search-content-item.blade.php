<app-book-search-content-item inline-template>
    <div class="col-md-offset-1 col-md-10">
        <ul class="list-group">
            <li class="list-group-item">
                <img data-width="300" data-height="350" src="{{ $book['image'] }}">
                <h5>{{ $book['title'] }}</h5>
                <button class="btn btn-primary-outline btn-sm">
                    <span class="icon icon-add-user"></span> Follow
                </button>
            </li>
        </ul>
    </div>
</app-book-search-content-item>
