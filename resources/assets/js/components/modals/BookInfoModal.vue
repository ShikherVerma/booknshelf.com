<template>
    <div class="modal is-active">
        <div class="modal-background book-info-modal-background"></div>
        <button @click="$emit('close')" class="modal-close-button delete"></button>
        <a class="modal--close v-desktop" data-test="modal-close" href="#" title="Close"></a>
        <div class="modal-card modal-card-book-info">
            <section class="modal-card-body book-info-modal-content">
                <div class="content">
                    <div class="container">
                        <div class="columns">
                            <div class="column is-3">
                                <div class="box book-info-image" :style="bookImage"></div>
                                <p class="subtile" style="margin-top: 20px;">
                                    <a v-if="book.detail_page_url"  target="_blank" style="background-color: #efefef;"
                                       class="button is-medium" :href="book.detail_page_url">
                                        <span class="icon is-medium">
                                            <i class="fa fa-amazon"></i>
                                        </span>
                                        <span>
                                            See on Amazon
                                        </span>
                                    </a>
                                    <a v-if="averageRating" target="_blank" :href="goodreadsUrl"
                                       class="button is-medium" style="background-color: #F4F1EA; margin-top: 10px;">
                                        <span class="icon is-medium star-icon">
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <span>
                                            <strong>{{this.averageRating}}<span class="outof-span">/5
                                                 ({{ ratingsCount }})</span>
                                            </strong>
                                        </span>
                                    </a>
                                </p>
                            </div>
                            <div class="column">
                                <p class="title">
                                        {{ book.title }}
                                </p>
                                <p class="subtitle">
                                    <span v-for="(author, index) in book.authors">
                                        <span v-if="index == 0">By </span>
                                        {{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                                    </span>
                                </p>
                                <!-- Show the description of the book -->
                            <p v-if="book.description && !authUserId" class="subtitle" v-html="book.description"></p>

                                <div v-if="authUserId" class="box" v-for="note in userNotes" style="background-color: #fcfffe">
                                    <article class="media">
                                        <div class="media-left">
                                            <figure class="image is-48x48">
                                                <img :src="getAvatarUrl(note.user.avatar)" class="book-info-modal-profile-pic" alt="Image">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <div class="content">
                                                <p>
                                                    <strong>{{ note.user.name }}</strong><small> 31m</small>
                                                    <span class="tag is-warning" v-if="note.is_private">Only visible to you</span>
                                                    <br>
                                                    {{ note.text }}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div v-if="authUserId" class="box" v-for="note in publicNotes">
                                    <article class="media">
                                        <div class="media-left">
                                            <figure class="image is-48x48">
                                                <img :src="getAvatarUrl(note.user.avatar)" class="book-info-modal-profile-pic" alt="Image">
                                            </figure>
                                        </div>
                                        <div class="media-content">
                                            <div class="content">
                                                <p>
                                                    <strong>{{ note.user.name }}</strong><small> 31m</small>
                                                    <br>
                                                    {{ note.text }}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <note-write v-if="authUserId" :book="book" :user="authUser"></note-write>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'book', 'likes', 'isSearch'],

        data() {
            return {
                authUserId: App.userId,
                showBookInfoModal: false,
                averageRating: null,
                ratingsCount: null,
                publicNotes: [],
                userNotes: [],
            };
        },
        mounted() {
            this.$http.get(`/books/${this.book.id}/reviews`)
                    .then(response => {
                        this.averageRating = response.body.average_rating;
                        this.ratingsCount = response.body.ratings_count;
            });
            if (this.authUserId) {
                this.getNotes();
            }
        },

        methods: {
            getNotes() {
                this.$http.get(`/books/${this.book.id}/notes`)
                    .then(function(response) {
                        this.publicNotes = response.body.public_notes;
                        this.userNotes = response.body.user_notes;
                    }).catch(function(reason) {
                        console.log(reason);
                    });;;
            },
            getAvatarUrl(avatar) {
                return "https://booknshelf.imgix.net/profiles/" + avatar +
                    "?auto=format&auto=compress&codec=mozjpeg&cs=strip&w=48&h=48&fit=crop";
            },
        },

        created: function () {
            Bus.$on('newNoteSaved', this.getNotes);
        },

        computed: {
            bookImage: function () {
                // search is exception
                if (this.isSearch) {
                    return `background-image: url(${this.book.cover_image})`;
                }
                if (this.book.cover_image) {
                    var coverImageUrl = "https://booknshelf.imgix.net/book-covers/" + this.book.cover_image + "?auto=format&fit=crop&h=290&w=200";
                    return `background-image: url(${coverImageUrl})`;
                }

                if (this.book.original_image) {
                    var coverImageUrl = "https://booknshelf.imgix.net/book-original-covers/" + this.book.image + "?auto=format&fit=crop&h=290&w=200";
                    return `background-image: url(${coverImageUrl})`;
                } else {
                    return '';
                }
            },
            goodreadsUrl: function () {
                return `https://www.goodreads.com/book/isbn/${this.book.isbn_10}`
            },
            authUser() {
                return  App.state.user;
            },
        }
    }
</script>

<style type="text/css">
    .book-info-modal-background {
        background-color: rgba(255,255,255,0.96);
    }
    .book-info-modal-content {
        background-color: #fff;
        border-radius: 3px;
        height: 650px;
        flex-direction: column;
        overflow: scroll;
    }

    .modal-card-book-info {
        min-width: 70%;
    }

    .book-info-modal-profile-pic {
        border-radius: 50%;
    }

    .book-info-image {
        height: 290px;
        width: 200px;
        background-position: center center;
        background-size: cover;
        cursor: pointer;
    }

    .star-icon {
        margin-right: 0px !important;
    }

    .outof-span {
        color: grey;
        font-size: 14px;
    }

    .ratings-count {
        color: grey;
        font-size: 15px;
    }

</style>
