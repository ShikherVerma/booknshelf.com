<template>
    <div class="col-md-3 parent">
        <div class="card card-shelf-book card-background card-raised" :style="bookCoverImage">
            <div class="content2">
                <span class="hover-content">
                    <small>
                        <button class="btn btn-success btn-sm btn-action" @click="showBookSaveModal()" type="button">
                            <span class="icon icon-add-to-list"></span> Save
                        </button>
                    </small>
                    <small>
                        <button v-show="onOwnProfile"class="btn btn-danger btn-sm" @click="removeBookFromShelf()">
                            <span class="icon icon-cross"></span>
                        </button>
                        <a v-if="book.detail_page_url" class="btn btn-default btn-sm btn-action"
                            :href="book.detail_page_url" target="_blank" type="button">
                            <i class="fa fa-amazon" aria-hidden="true"></i>
                        </a>
                    </small>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'book', 'shelf'],

        data() {
            return {
                form: new AppForm({
                    id: '',
                })
            }
        },

        methods: {

            // remove the book from the bookshelf
            removeBookFromShelf() {
                this.form.id = this.book.id;
                let form = new AppForm({ id: this.book.id });
                App.delete(`/shelves/${this.shelf.id}/books/${this.book.id}`, form)
                    .then(() =>{
                        this.$eventHub.$emit('bookRemoved');
                    }).catch(function(reason) {})
            },
            showBookSaveModal() {
                // if user is authenticated then show the save modal, otherwise login modal
                if (App.userId) {
                    this.$eventHub.$emit('showBookSaveModal', this.book);
                } else {
                    this.$eventHub.$emit('showPleaseLoginModal');
                }
            }
        },

        computed: {
            bookCoverImage: function () {
                return `background-image: url(${this.book.cover_image || this.book.image})`;
            },
            onOwnProfile() {
                return App.userId === this.user.id;
            },
        }
    }
</script>

<style type="text/css">
    .card-background:after {
        content:none !important;
    }
    .card-shelf-book {
        height: 350px;
        width: 250px;
        text-align: left;
        padding-left: 10px;
        padding-top: 10px;
        position: static !important;
    }
    .card-shelf-book:after {
        background-color: rgba(0, 0, 0, 0);
    }
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
