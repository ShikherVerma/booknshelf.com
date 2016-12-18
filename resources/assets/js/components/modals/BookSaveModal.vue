<template>
    <transition name="modal">
        <div class="modal-mask" @click="close"  v-show="show">
            <div class="modal-wrapper">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <button @click="close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="icon icon-cross"></span>
                        </button>
                        <h4 name="header" class="text-center">
                            Add to bookshelf
                        </h4>
                    </div>
                    <div class="modal-body p-a-0">
                        <div class="modal-body-scroller">
                            <div name="body">
                                <ul class="list-group">
                                    <li>
                                        <a class="btn btn-success" @click="showNewShelfForm=!showNewShelfForm">
                                            <i class="fa fa-plus" aria-hidden="true"></i> CREATE NEW BOOKSHELF
                                        </a>
                                    </li>
                                    <li>
                                        <span v-show="showNewShelfForm">
                                            <form v-on:submit.prevent="storeBookToNewBookshelf" class="form-horizontal p-b-none m-b-none" role="form">
                                                <div class="input-group">
                                                    <input v-model="form.name" type="text" class="form-control"
                                                        placeholder="What's the name of the new bookshelf?">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-success" type="submit" :disabled="form.busy">CREATE</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </span>
                                    </li>
                                </ul>
                                <div v-show="success" class="alert alert-success">
                                    <div class="container">
                                        <div class="alert-icon">
                                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                                        </div> The book has been added to your bookshelf.
                                    </div>
                                </div>
                                <span class="help-block error-block" v-show="form.errors.has('name')">
                                    {{ form.errors.get('name') }}
                                </span>
                                <spinner v-show="loading"></spinner>
                                <ul v-show="!loading" class="list-group" v-for="shelf in shelves">
                                    <li id="book.id" class="list-group-item shelf-list-item"
                                        @click="storeBookToShelf(shelf.id)">{{ shelf.name }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </transition>
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
                // this.loading = true;
                this.$eventHub.$emit('closeBookSaveModal');
            },
        },

        created() {
            this.$eventHub.$on('loadUserShelves', this.getUserBookshelves);
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
    .modal-mask {
      position: fixed;
      z-index: 9998;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, .5);
      display: table;
      transition: opacity .3s ease;
    }

    .modal-wrapper {
      display: table-cell;
      vertical-align: middle;
    }

    .modal-container {
      width: 600px;
      margin: 0px auto;
      padding: 20px 30px;
      background-color: #fff;
      border-radius: 2px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
      transition: all .3s ease;
    }

    .modal-header h3 {
      margin-top: 0;
      color: #42b983;
    }

    .modal-body {
      margin: 20px 0;
    }

    .modal-default-button {
      float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
      opacity: 0;
    }

    .modal-leave-active {
      opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    }

    .shelf-list-item {
      margin-bottom: 10px;
      color: #072b54;
      font-weight: bold;
      cursor: pointer;
    }
    .shelf-list-item:hover {
      background-color: #eff3f9;
    }
    .error-block {
        color: #9b1414;
    }
</style>
