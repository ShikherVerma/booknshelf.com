
<app-shelf-search-bar inline-template>
    <form class="navbar-form" role="form" v-on:submit.prevent="search">
        <div class="input-group">
            <input id="book-search" type="text" class="form-control"
                   v-model="query"
                   placeholder="Search for great bookshelves ..."
                   v-on:keyup="search"
            >
            <ul class="media-list media-list-users list-group media-shelf">
                <li v-for="shelf in shelves" class="list-group-item">
                    <h5 v-html="shelf._highlightResult.name.value"></h5>
                </li>
            </ul>

        </div>
    </form>
</app-shelf-search-bar>