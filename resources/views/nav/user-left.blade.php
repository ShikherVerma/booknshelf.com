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
    <a href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
        MY BOOKSHELVES
    </a>
</li>
<li>
    <a @click="showCreateShelfModal">
            CREATE
    </a>
</li>
