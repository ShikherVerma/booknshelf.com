<!-- Left Side Of Navbar -->
<li>
    <a>
        @include('search.book-search-bar')
    </a>
</li>
<li>
    <a href="/">
        OUR PICKS
    </a>
</li>
<li>
    <a href="/{{ '@' . Auth::user()->username }}/bookshelves">
        MY BOOKSHELVES
    </a>
</li>
<li>
    <a @click="showCreateShelfModal">
            CREATE
    </a>
</li>
