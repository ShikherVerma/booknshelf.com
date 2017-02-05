<template>
    <div class="modal is-active" @click="close" v-show="show">
        <div class="modal-background" @click="close"></div>
        <div class="modal-card" @click.stop>
            <header class="modal-card-head">
                <p class="modal-card-title">Add to Bookshelf</p>
                <button @click="close" class="delete"></button>
            </header>
            <section class="modal-card-body">
                <p class="control">
                    <a class="button is-primary" @click="showNewShelfForm=!showNewShelfForm">
                        <span class="icon">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span>Create new bookshelf</span>
                    </a>
                </p>
                <form v-on:submit.prevent="storeBookToNewBookshelf">
                    <p class="control has-addons" v-if="showNewShelfForm">
                        <input class="input" name="name" type="text" v-model="form.name"
                               :class="{'is-danger': form.errors.has('name')}" placeholder="The bookshelf name ...">
                        <button class="button is-primary" type="submit" :disabled="form.busy">Create</button>
                    </p>
                </form>
                <span class="help is-danger" v-if="form.errors.has('name')">
                    {{ form.errors.get('name') }}
                </span>

                <div v-show="success" class="notification is-success">
                    The book has been added to your bookshelf.
                </div>
                <spinner v-show="loading"></spinner>
                <p class="control" v-show="!loading">
                    <div v-for="shelf in shelves"
                         class="notification shelf-list-item" @click="storeBookToShelf(shelf.id)">
                        {{ shelf.name }}
                    </div>
                </p>
            </section>
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

            storeBookToShelf(shelfId) {
                this.form.id = this.book.id;
                App.post(`/shelves/${shelfId}/books`, this.form)
                    .then(() => {
                        this.success = true;
                    }).catch(function(reason) {
                        console.log(reason);
                    });
            },

            storeBookToNewBookshelf() {
                App.post('/shelves', this.form)
                    .then((response) => {
                        var shelfId = response.id;
                        this.form.name = '';
                        // add the book to the new shelf
                        this.storeBookToShelf(shelfId);
                        this.success = true;
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
        }
    }


</script>
<style lang="css">
    .shelf-list-item {
        cursor: pointer;
    }
    .shelf-list-item:hover {
        background-color: #00d1b2;
    }
</style>
