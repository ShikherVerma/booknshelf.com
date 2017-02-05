<template>
    <div class="column is-2 profile-like-book">
        <div class="box book hvr-grow" :style="bookCoverImage"></div>
        <p class="subtitle">
            <a class="button is-outlined" :class="{ 'saved-button': isSaved}" @click="showBookSaveModal()">
                <span class="icon">
                    <i class="fa fa-plus" :class="{ 'saved-icon': isSaved}"></i>
                </span>
            </a>
            <a class="button is-outlined" :class="{ 'liked-button': isLikedByAuthUser}" @click="recommendBook()">
                <span class="icon">
                    <i class="fa fa-heart" :class="{ 'liked-icon': isLikedByAuthUser}"></i>
                </span>
                <span class="small-span">{{ likesCount }}</span>
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
        props: ['user', 'book', 'likes'],

        data() {
            return {
                form: new AppForm({
                    id: '',
                }),
                likesCount: this.book.likes.length,
                isLiked: true,
                isSaved: true,
            }
        },

        methods: {

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
                            // update the user and also load user's liked books
                            Bus.$emit('updateUserData');
                            this.updateBookLikesCount();
                        }).catch(function(reason) {
                            console.log(reason);
                        })
                } else {
                    Bus.$emit('showPleaseLoginModal');
                }
            },

            updateBookLikesCount() {
                this.$http.get(`/books/${this.book.id}/likes`)
                    .then(response => {
                        this.likesCount = response.data.length;
                    });
                }
            },

        computed: {
            bookCoverImage: function () {
                if (this.book.cover_image || this.book.image) {
                    return `background-image: url(${this.book.cover_image || this.book.image})`;
                } else {
                    return '';
                }
            },
            isLikedByAuthUser: function () {
                return (this.likes.indexOf(this.book.id) != -1)
            }
        }
    }


</script>

<style>
    .book {
        height: 250px;
        background-position: center center;
        background-size: cover;
    }
    .parent {
        position: relative;
    }
    .book-title {
        font-size: 1.5rem;
    }
    .profile-like-book .icon .fa {
        font-size: 15px;
    }

    .small-span {
        font-weight: 800 !important;
        font-size: 12px;
        color: #a2a2a2;
    }


    .liked-button {
        background-color: #f15151;
        color: white;
        font-weight: bold;
    }
    .liked-icon {
        color: #FFFFFF !important;
    }
    .liked-button span {
        font-weight: 800;
        font-size: 12px;
        color: white !important;
    }
    .liked-button:hover {
        color: white;
    }

    .saved-button {
        background-color: hsla(171, 100%, 36%, 1);
        color: white;
        font-weight: bold;
    }
    .saved-icon {
        color: #FFFFFF !important;
    }




</style>
