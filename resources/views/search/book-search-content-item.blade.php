<app-book-search-content-item inline-template>
    <div class="col-md-3">
        <div class="panel panel-default panel-profile">
<!--             <div class="panel-heading">
            </div> -->
            <div class="panel-body text-center">
                <img data-width="300" data-height="350" src="{{ $book['image'] }}">
                <h5 class="panel-title">{{ $book['title'] }}</h5>
                <button class="btn btn-primary-outline btn-sm">
                    <span class="icon icon-add-user"></span> Follow
                </button>
            </div>
        </div>
    </div>
</app-book-search-content-item>
