<template>
    <div class="modal is-active" @click="$emit('close')">
        <div class="modal-background book-info-modal-background" @click="$emit('close')"></div>
        <button @click="$emit('close')" class="modal-close-button delete"></button>
        <a class="modal--close v-desktop" data-test="modal-close" href="#" title="Close"></a>
        <div class="modal-card modal-card-book-info">
            <section class="modal-card-body book-info-modal-content">
                <div class="content">
                    <div class="container">
                        <div class="columns">
                            <div class="column is-5">
                                <div class="box book-info-image" :style="bookImage"></div>
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
                                <p v-if="book.description" class="subtitle" v-html="book.description"></p>

                                <p class="subtile" style="margin-top: 20px;">
                                    <a v-if="book.detail_page_url"  target="_blank" style="background-color: #efefef;"
                                       class="button is-medium" :href="book.detail_page_url">
                                        <span class="icon is-medium">
                                            <i class="fa fa-amazon"></i>
                                        </span>
                                        <span>
                                            Buy on Amazon
                                        </span>
                                    </a>
                                    <a v-if="averageRating" target="_blank" :href="goodreadsUrl"
                                       class="button is-medium" style="background-color: #F4F1EA;">
                                        <span class="icon is-medium star-icon">
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <span>
                                            <strong>{{this.averageRating}}<span class="outof-span">/5
                                                 ({{ ratingsCount }})</span></strong> on Goodreads
                                        </span>
                                    </a>
                                </p>
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
        props: ['user', 'book', 'likes'],

        data() {
            return {
                showBookInfoModal: false,
                averageRating: null,
                ratingsCount: null,
            };
        },
        mounted() {
            this.$http.get(`/books/${this.book.id}/reviews`)
                    .then(response => {
                        this.averageRating = response.body.average_rating;
                        this.ratingsCount = response.body.ratings_count;
            });
        },

        computed: {
            bookImage: function () {
                if (this.book.cover_image || this.book.original) {
                    return `background-image: url(${this.book.cover_image || this.book.original_image})`;
                } else {
                    return '';
                }
            },
            goodreadsUrl: function () {
                return `https://www.goodreads.com/book/isbn/${this.book.isbn_10}`
            }
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

    .book-info-image {
        height: 450px;
        width: 295px;
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
