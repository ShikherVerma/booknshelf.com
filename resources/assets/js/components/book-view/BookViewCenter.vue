<template>
    <div class="column is-2">
        <p>
            <a v-if="book.detail_page_url"  target="_blank" style="background-color: #efefef;"
               class="button" :href="book.detail_page_url">
                <span class="icon is-small">
                    <i class="fa fa-amazon"></i>
                </span>
                <span>
                    See on Amazon
                </span>
            </a>
        </p>
        <p>
            <a v-if="averageRating" target="_blank" :href="goodreadsUrl"
               class="button" style="background-color: #F4F1EA;">
                <span class="icon is-small">
                    <i class="fa fa-star"></i>
                </span>
                <span>
                    <strong>{{this.averageRating}}<span class="outof-span">/5
                         ({{ ratingsCount }})</span></strong> on Goodreads
                </span>
            </a>
        </p>

    </div>
</template>

<script>
    export default {
        props: ['book', 'user'],

        data() {
            return {
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
            goodreadsUrl: function () {
                return `https://www.goodreads.com/book/isbn/${this.book.isbn_10}`
            }
        }
    }
</script>

<style lang="css">
    .modal-card-book-info {
        min-width: 70%;
    }

/*    .book-info-image {
        height: 450px;
        width: 295px;
        background-position: center center;
        background-size: cover;
        cursor: pointer;
    }*/

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
