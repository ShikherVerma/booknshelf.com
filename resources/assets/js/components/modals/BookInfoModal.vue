<template>
    <div class="modal is-active">
        <div class="modal-background" @click="$emit('close')"></div>
        <div class="modal-card">
            <section class="modal-card-body">
                <div class="content">
                    <div class="container">
                        <div class="columns">
                            <div class="column is-5">
                                <div class="box book-info-image" :style="bookImage"></div>
                            </div>
                            <div class="column">
                                <p class="subtitle" style="margin-bottom: 0px;">
                                    <strong>
                                        <span class="primary-span-inverse"> {{ book.title }}</span>
                                    </strong>
                                </p>
                                <p class="subtitle blue-span">
                                    <span v-for="(author, index) in book.authors">
                                        {{ author.name }}<span v-if="index !== book.authors.length - 1">, </span>
                                    </span>
                                </p>
                                
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
                        console.log(response.body);
                        this.averageRating = response.body.average_rating;
                        this.ratingsCount = response.body.ratings_count;
                        console.log(this.averageRating);
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

<style class="css">
    .modal-card {
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