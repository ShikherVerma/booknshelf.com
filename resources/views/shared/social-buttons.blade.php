<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<div class="social-container">
    {{--<div class="social-container-item">--}}
        {{--<a class="btn btn-default btn-sm" href="#">--}}
            {{--<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> Edit</a>--}}
    {{--</div>--}}

    <div class="social-container-item">
        <!-- tweet button code -->
        <a class="twitter-share-button"
          href="https://twitter.com/share"
          data-size="large"
          data-text="{{ $shelf->name }}"
          data-url="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}"
          data-via="booknshelf"
          data-related="books,reading">
        Tweet
        </a>
    </div>
    <div class="social-container-item">
        <!-- share button code -->
        <a class="fb-share-button"
             data-href="{{ route('shelf_path', ['username' => $shelf['user']['username'], 'shelf_slig' =>$shelf['slug']]) }}"
             data-size="large"
             data-layout="button">
        </a>
    </div>

</div>