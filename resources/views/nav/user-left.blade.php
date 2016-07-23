<!-- Left Side Of Navbar -->
<li>
    <a>
        @include('search.book-search-bar')
    </a>
</li>
<li>
    <a href="/">
        Our Picks
    </a>
</li>
<li>
    <a href="/{{ '@' . Auth::user()->username }}/bookshelves">
        My Bookshelves
    </a>
</li>
<li>
    <a @click="showCreateShelfModal">
            Create
    </a>
</li>
