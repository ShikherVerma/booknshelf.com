<!-- Left Side Of Navbar -->
<li>
    <a>
        @include('search.book-search-bar')
    </a>
</li>
<li>
    <a name="my-bookshelves" href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
        MY BOOKSHELVES
    </a>
</li>
<li>
    <a href="/friends">
        FRIENDS
    </a>
</li>
