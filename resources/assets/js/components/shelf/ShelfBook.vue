<template>
    <div class="col-md-3 parent">
        <div class="card card-product card-book">
            <div class="card-image">
                <div class="hover-content">
                    <small style="margin-left: 3px;">
                        <a class="btn btn-default btn-sm" :href="book.detail_page_url" target="_blank" type="button">
                            <i class="fa fa-amazon" aria-hidden="true"></i>
                        </a>
                        <a href="#pablo" class="btn btn-success btn-sm">
                            <i class="material-icons">playlist_add</i>
                            <div class="ripple-container"></div>
                        </a>
                    </small>
                </div>
                <a href="#pablo">
                    <img class="img img-raised" :src="book.cover_image || book.image" />
                </a>
            </div>
            <div class="content">
                <p class="card-title text-small">
                    {{ book.title }}
                </p>
                <p class="card-description">
                    <small v-for="(author, index) in book.authors">
                        {{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                    </small>
                </p>
                <div class="footer">
                    <div class="stats">
                        <button type="button" rel="tooltip" title="Save" class="btn btn-just-icon btn-simple btn-success">
                            <i class="material-icons">playlist_add</i>
                        </button>
                        <button type="button" rel="tooltip" title="Like" class="btn btn-just-icon btn-simple btn-default">
                            <i class="material-icons">favorite</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'book'],

        mounted() {
            console.log('Component book-shelf is ready.')
        }
    }
</script>
