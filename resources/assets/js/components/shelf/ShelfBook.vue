<template>
    <div class="column is-2">
        <div class="box book hvr-grow" :style="bookCoverImage">
        </div>
        <p class="subtitle">
            <span class="icon" @click="recommendBook()">
                <i class="fa fa-heart" :class="{ 'like-heart': isLiked}"></i>
            </span>
            <span class="icon" @click="showBookSaveModal()">
                <i class="fa fa-bookmark" :class="{ 'like-save': isSaved}"></i>
            </span>
            <a v-if="book.detail_page_url" class="button is-small is-light"
                :href="book.detail_page_url" target="_blank">
                <span class="icon">
                    <i class="fa fa-amazon"></i>
                </span>
            </a>
            <a v-show="onOwnProfile" class="button is-small is-light" @click="removeBookFromShelf()">
                <span class="icon">
                    <i class="fa fa-times"></i>
                </span>
            </a>
        </p>
        <a :href="url">
            <h4 class="title book-title">{{ book.title }}</h4>
        </a>
        <p class="subtitle">
            <span v-for="(author, index) in book.authors">
                {{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
            </span>
        </p>
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
                isLiked: false,
                isSaved: false
            }
        },

        methods: {

            // remove the book from the bookshelf
            removeBookFromShelf() {
                this.form.id = this.book.id;
                let form = new AppForm({ id: this.book.id });
                App.delete(`/shelves/${this.shelf.id}/books/${this.book.id}`, form)
                    .then(() =>{
                        Bus.$emit('bookRemoved');
                    }).catch(function(reason) {})
            },

            showBookSaveModal() {
                // if user is authenticated then show the save modal, otherwise login modal
                if (App.userId) {
                    Bus.$emit('showBookSaveModal', this.book);
                } else {
                    Bus.$emit('showPleaseLoginModal');
                }
            },

            recommendBook() {
                // if user is authenticated then show the save modal, otherwise login modal
                if (App.userId) {
                    let likeForm = new AppForm({});
                    App.post(`/likes/books/${this.book.id}/toggle`, likeForm)
                        .then(() => {
                        }).catch(function(reason) {
                            console.log(reason);
                        })
                    this.isLiked = !this.isLiked;
                } else {
                    Bus.$emit('showPleaseLoginModal');
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
    .book {
        height: 250px;
        background-position: center center;
        background-size: cover;
    }
    .parent {
        position: relative;
    }
    .fa-heart, .fa-bookmark {
        color: #a2a2a2;
        cursor: pointer;
    }
    .fa-heart:hover {
        color: #bf4646;
    }

    .fa-bookmark:hover {
        color: #00d1b2;
    }

    .like-heart {
        color: #bf4646 !important;
     }

     .like-save {
        color: #00AB91 !important;
     }

    .book-title {
        font-size: 1.5rem;
    }
</style>
