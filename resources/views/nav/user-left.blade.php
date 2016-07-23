<!-- Left Side Of Navbar -->
<li>
    <a>
        @include('search.book-search-bar')
    </a>
</li>
<li>
    <a>
        Our Picks
    </a>
</li>
<li>
    <a>
        My Bookshelves
    </a>
</li>
<li>
    <a @click="showCreateShelfModal">
            Create
    </a>
</li>
