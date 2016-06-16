<app-book-search-content-item inline-template>
    <div class="box box-book">
        <div class="p20 clearfix flexbox">
            <div class="box-img">
                <a class="center-block" href="/">
                    <img src="{{ $book['image'] }}" alt>
                </a>
            </div>
            <div class="box-txt">
                <div class="book-title">
                    {{ $book['title'] }}
                </div>
            </div>

        </div>
    </div>
</app-book-search-content-item>
