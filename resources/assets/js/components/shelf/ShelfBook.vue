<template>
<div class="card card-background card-raised grid-item-book parent" :style="bookCoverImage">
    <div class="hover-content">
        <div class="buttons-div">
            <small>
                <button class="btn btn-default" @click="recommendBook()" type="button">
                      <span class="icon icon-heart" :class="{ 'text-danger': isLiked}"></span>
                </button>
            </small>
            <small>
                <button class="btn btn-info" @click="showBookSaveModal()" type="button">
                    <span class="icon icon-add-to-list"></span> Save
                </button>
            </small>
            <small>
                <a v-if="book.detail_page_url" class="btn btn-default"
                    :href="book.detail_page_url" target="_blank" type="button">
                    <i class="fa fa-amazon" aria-hidden="true"></i>
                </a>
                <button v-show="onOwnProfile"class="btn btn-danger" @click="removeBookFromShelf()" type="button">
                    <span class="icon icon-cross"></span>
                </button>
            </small>
        </div>

        <div class="book-title">
           {{ book.title }}
            <p>
                <span class="book-author" v-for="(author, index) in book.authors">
                    {{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                </span>
            </p>
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
                }),
                isLiked: false
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
            },

            recommendBook() {
                // if user is authenticated then show the save modal, otherwise login modal
                if (App.userId) {
                    let likeForm = new AppForm({});
                    App.post(`/likes/books/${this.book.id}/toggle`, likeForm)
                        .then(() => {
                            console.log("Liked!");
                        }).catch(function(reason) {
                            console.log(reason);
                        })
                    this.isLiked = !this.isLiked;
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

    .parent {
        position: relative;
    }
    .hover-content {
      display:none;
      height: 100%;
      width: 100%;
      background-color: rgba(25, 27, 27, 0.65);
      position: absolute;
    }
    .parent:hover .hover-content {
      display: block;
    }

    .buttons-div {
        margin-top: 5px;
        padding-left: 5px;
        text-align: left;
    }

    .book-title {
        margin-top: 35%;
        font-size: 16px;
        font-weight: bold;
    }

    .book-title > p {
        margin-top: 7px;
    }

    .book-author {
        font-size: 13px;
    }

    .btn-default {
        border: none;
    }
</style>
