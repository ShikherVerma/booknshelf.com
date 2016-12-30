<template>
    <div class="container m-t-lg">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-group media-list media-list-stream">
                    <li v-for="book in books"
                        class="media list-group-item p-a search-item parent">
                        <a class="media-left" href="#">
                            <img class="media-object search-item-book-cover" style="width: 150px;" :src="book.cover_image">
                        </a>
                        <div class="media-body">
                            <div class="media-body-text">
                                <div class="media-heading">
                                    <h5>{{ book.title }}</h5>
                                </div>
                                <p>
                                    <span v-for="(author, index) in book.authors">
                                        {{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                                    </span>
                                </p>
                            </div>
                            <div class="media-footer hover-content">
                                <small v-show="!saved">
                                    <button class="btn btn-success btn-sm btn-action" @click="showBookSaveModal(book)" type="button">
                                        <span class="icon icon-add-to-list"></span> Save
                                    </button>
                                </small>
                                <small v-show="saved">
                                    <button class="btn btn-success btn-sm btn-action" @click="showBookSaveModal(book)" type="button">
                                        <span class="icon icon-check"></span> Saved
                                    </button>
                                </small>
                                <small>
                                    <a class="btn btn-default btn-sm btn-action" :href="book.detail_page_url" target="_blank" type="button">
                                        <i class="fa fa-amazon" aria-hidden="true"></i>
                                    </a>
                                </small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>

</template>

<script>
    export default {

        props: ['books', 'mostSavedBooks'],

        data() {
            return {
                saved: false,
                form: new AppForm({
                    id: '',
                    name: '',
                }),
            }
        },

        methods: {

            showSavePopover() {
                // display a loading state here
                this.getUserBookshelves();
                this.loading = false;
            },

            showBookSaveModal(book) {
                // if user is authenticated then show the save modal, otherwise login modal
                if (App.userId) {
                    this.$eventHub.$emit('showBookSaveModal', book);
                } else {
                    this.$eventHub.$emit('showPleaseLoginModal');
                }
            }

        },

        events: {
            bookSaved() {
                this.saved = true;
            }
        }
    }
</script>

<style lang="sass">
    $search-item-bg: #fff;

    .search-item {
        cursor: pointer;
    }

    .search-item:hover {
      background-color: darken($search-item-bg, 3%);
    }

    .btn-action {
      font-size: 11px;
      margin-right: 10px;
    }

    .search-item-book-cover {
      border-radius: 0px !important;
      width: 125px !important;
    }

    .book-card {
      position: relative;
      height: 350px;
      width: 250px;
    }

    #book-card-actions {
      display:none;
      position: absolute;
      top: 20px;
      right: 20px;
    }
    .book-card:hover #book-card-actions {
        display:block;
    }

    // To support hover affect on elements
    .parent {
      position: relative;
    }
    .hover-content {
      display:none;
      position: absolute;
    }
    .parent:hover .hover-content {
      display: block;
    }
</style>
