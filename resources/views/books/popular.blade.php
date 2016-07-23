<div class="panel panel-default m-b-md hidden-xs">
    <div class="panel-body">
        <h5>
            Most Saved Books
        </h5>
        <ul class="media-list media-list-users list-group">
            @foreach ($mostSavedBooks as $book)
                <li class="list-group-item">
                    <div class="media">
                        <a class="media-left" href="#">
                            <img class="media-object img-circle img-circle-book-cover" src="{{ $book->image or '' }}">
                        </a>
                        <div class="media-body">
                            <strong>{{ $book->title }}</strong>
                            <small class="text-muted">
                                <a class="btn btn-sm btn-tiny" href="{{ $book->google_info_link or '' }}" target="_blank">
                                    <i class="fa fa-external-link" aria-hidden="true"></i>
                                </a>
                            </small>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>