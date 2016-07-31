
<app-shelf-search-bar :user="user" inline-template>
    <form class="navbar-form" role="form" v-on:submit.prevent="search">
        <div class="input-group">
            <input id="book-search" type="text" class="form-control"
                   v-model="query"
                   placeholder="Search for users or bookshelves ..."
                   v-on:keyup="search"
            >
            <template v-if="shelves.length > 0">
                <ul class="media-list media-list-users list-group media-shelf">
                    <li v-for="shelf in shelves" class="list-group-item">
                        <a href="/@@{{shelf.user.username}}/shelves/@{{ shelf.slug }}">
                            <h5 v-html="shelf._highlightResult.name.value"></h5>
                        </a>
                        by<a href="/@@{{shelf.user.username}}">
                            <span v-html="shelf._highlightResult.user.name.value"></span>
                        </a>
                    </li>
                </ul>
            </template>

        </div>
    </form>
</app-shelf-search-bar>