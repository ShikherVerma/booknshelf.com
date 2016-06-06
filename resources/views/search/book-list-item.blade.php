<app-book-list-item :user="user" inline-template>
    <div class="row">
        <div class="col-md-4">
            <a href="#">
                <img class="img-responsive" src="{{ $book['image'] }}" alt="">
            </a>
        </div>
        <div class="col-md-7">
            <h3>{{ $book['title'] }} <span> ({{ $book['rating'] }}) </span></h3>
            <h4>{{ $book['subtitle'] }}</h4>
            <a class="btn btn-primary" target="_blank" href="{{ $book['info_link'] }}">Link on Google Books</a>
        </div>
    </div>
</app-book-list-item>
