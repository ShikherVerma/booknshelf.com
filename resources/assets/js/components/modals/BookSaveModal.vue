<template>
    <div class="modal is-active" @click="close" v-show="show">
        <div class="modal-background book-save-modal-background" @click="close"></div>
        <button @click="close" class="modal-close-button delete"></button>
        <a class="modal--close v-desktop" data-test="modal-close" href="#" title="Close"></a>
        <div class="modal-content book-save-modal-content" @click.stop>
            <div class="container">
                <div class="columns">
                    <div class="column is-half modal-left">
                        <div class="box save-modal-book" :style="bookCoverImage"></div>
                    </div>
                    <div class="column is-half modal-right">
                        <p class="subtitle"><strong>CHOOSE BOOKSHELF</strong></p>
                        <spinner v-show="loading"></spinner>
                        <div class="shelves-list" v-show="!loading">
                            <div v-for="shelf in shelves"
                                 class="shelf-list-item" @click="storeBookToShelf(shelf.id, shelf.name)">
                                <p class="subtitle" style="font-weight: 600;">
                                    {{ shelf.name }}
                                </p>
                            </div>
                        </div>
                        <p class="control" style="margin-top: 5px;" v-if="!showNewShelfForm">
                            <a class="button is-light" @click="showNewShelfForm=!showNewShelfForm">
                                <span class="icon">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span>ADD NEW</span>
                            </a>
                        </p>
                        <p class="control" style="margin-top: 5px;">
                            <form v-on:submit.prevent="storeBookToNewBookshelf()"  v-if="showNewShelfForm">
                                <p class="control is-expanded has-addons">
                                    <input class="input" name="name" type="text" v-model="form.name"
                                           :class="{'is-danger': form.errors.has('name')}" placeholder="Bookshelf name">
                                    <button class="button is-light" type="submit" :disabled="form.busy">Create</button>
                                </p>
                            </form>
                        </p>
                        <div class="notification is-danger" style="padding:5px;" v-if="form.errors.has('name')">
                            {{ form.errors.get('name') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'book', 'show'],

        data() {
            return {
                shelves: [],
                showNewShelfForm: false,
                success: false,
                loading: true,
                form: new AppForm({
                    id: '',
                }),
            }
        },

        methods: {
            // get user's all bookshelves
            getUserBookshelves() {
                this.$http.get('/user/shelves')
                    .then(function(response) {
                        this.loading = false;
                        this.shelves = response.data;
                    }).catch(function(reason) {
                        console.log(reason);
                    });
            },

            storeBookToShelf(shelfId, shelfName) {
                this.form.id = this.book.id;
                App.post(`/shelves/${shelfId}/books`, this.form)
                    .then(() => {
                        this.success = true;
                        // reload the user data
                        Bus.$emit('updateUserData');
                        this.close();
                        // send a notification
                        Vue.toast('Added "' + this.book.title + '" to "' + shelfName + '" shelf', {
                            className: ['notification', 'is-success', 'save-book-notification'],
                            horizontalPosition: 'right',
                            verticalPosition: 'bottom',
                            duration: 5000,
                        });
                    }).catch(function(reason) {
                        console.log(reason);
                    });
            },

            storeBookToNewBookshelf() {
                App.post('/shelves', this.form)
                    .then((response) => {
                        var shelfId = response.id;
                        // add the book to the new shelf
                        this.storeBookToShelf(shelfId, this.form.name);
                        this.form.name = '';
                    }).catch(function(reason) {
                        console.log(reason);
                    });
            },

            close: function () {
                this.success = false;
                this.showNewShelfForm = false;
                this.form.errors.forget();
                Bus.$emit('closeBookSaveModal');
            },
        },

        created() {
            Bus.$on('loadUserShelves', this.getUserBookshelves);
        },

        mounted: function () {
            this.$nextTick(function () {
                document.addEventListener("keydown", (e) => {
                    if (this.show && e.keyCode == 27) {
                        this.close();
                    }
                });
            })
        },
        computed: {
            bookCoverImage: function () {
                if (this.book && (this.book.cover_image || this.book.image)) {
                    return `background-image: url(${this.book.cover_image || this.book.image})`;
                } else {
                    return '';
                }
            }
        }
    }


</script>
<style lang="css">
    .save-modal-book {
        height: 300px;
        background-position: center center;
        background-size: cover;
    }
    .book-save-modal-background {
        background-color: rgba(255,255,255,0.96);
    }
    .book-save-modal-content {
        /*border: 1px solid #e8e8e8;*/
        background-color: #fff;
        border-radius: 3px;
        height: 650px;
        flex-direction: column;
        /*hide horizontal scrolling*/
        /*overflow: hidden;*/
        overflow: scroll;
    }
    .modal-left {
        padding: 60px;
        border-right: 1px solid #e8e8e8;
        align-items: center;
    }
    .modal-right {
        padding: 20px 20px 10px;
    }

    .shelves-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .shelf-list-item {
        cursor: pointer;
        padding: 7px;
    }
    .shelf-list-item:hover {
        background-color: #dbdbdb;
    }
    .save-book-notification {
        margin-right: 50px;
        margin-bottom: 50px;
        font-weight: bold;
    }

</style>
