
<app-shelf-search-bar :user="user" inline-template>
    <form class="navbar-form" role="form" v-on:submit.prevent="search">
        <input id="algolia-search" type="text" class="form-control" placeholder="Search for users or bookshelves ...">
    </form>
</app-shelf-search-bar>