<template>
    <div class="profile-header shelf-page-header text-center">
        <div class="container">
            <div class="col-md-2">
                <a class="twitter-share-button"
                  href="https://twitter.com/share"
                  text="Awesome collection"
                  data-size="large"
                  data-url="https://dev.twitter.com/web/tweet-button"
                  data-hashtags="books,reading"
                  data-via="booknshelf"
                  target="_blank">
                Tweet
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://booknshelf.com" target="_blank">
                  Share
                </a>
            </div>
            <div class="col-md-8">
                <h2 class="profile-header-user shelf-header-user">{{ shelf.name }}</h2>
                <p v-if="shelf.description" class="profile-header-bio">
                    {{ shelf.description}}
                </p>
                <span>
                    <img class="img-circle small-profile-photo" :src="user.avatar">
                    <a class="profile-name" :href="profileUrl">
                        {{ user.name }}
                    </a>
                </span>
            </div>
            <div v-if="canEditOrDelete" class="col-md-2">
                <button class="btn btn-default" @click="showEditShelfModal()">
                    <i class="fa fa-pencil"></i> Edit
                </button>
            </div>
        </div>

        <nav class="profile-header-nav">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#" class="books-count">{{ books.length }} Books</a>
                </li>
            </ul>
        </nav>

        <!-- Update Shelf Modal -->
        <div id="modal-update-shelf" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="updatingShelf">
                <div class="modal-content">
                    <div class="modal-header p-a">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit Bookshelf
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Update Shelf Form -->
                        <form class="form-horizontal" v-on:submit.prevent role="form">
                            <!-- Shelf Name -->
                            <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('name')}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" v-model="updateShelfForm.name">

                                    <span class="help-block" v-show="updateShelfForm.errors.has('name')">
                                        {{ updateShelfForm.errors.get('name') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Shelf Description -->
                            <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('description')}">
                                <label class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" v-model="updateShelfForm.description">
                                    </textarea>

                                    <span class="help-block" v-show="updateShelfForm.errors.has('description')">
                                        {{ updateShelfForm.errors.get('description') }}
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click.prevent="deleteShelf">
                            Delete Bookshelf
                        </button>
                        <button type="button" class="btn btn-primary-outline" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click.prevent="updateShelf" :disabled="updateShelfForm.busy">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelf', 'books'],

        data() {
            return {
                updatingShelf: null,
                deletingShelf: null,
                updateShelfForm: new AppForm({
                    name: '',
                    description: '',
                }),
                deleteShelfForm: new AppForm({}),
            }
        },

        methods: {

            showEditShelfModal(shelf) {
                this.updatingShelf = this.shelf;
                this.initializeUpdateFormWith(this.shelf);
                $('#modal-update-shelf').modal('show');
            },

            /**
             * Initialize the edit form with the given shelf.
             */
            initializeUpdateFormWith(shelf) {
                this.updateShelfForm.name = shelf.name;
                this.updateShelfForm.description = shelf.description;
            },


            /**
             * Update the shelf being edited.
             */
            updateShelf() {
                App.put(`/shelves/${this.updatingShelf.id}`, this.updateShelfForm)
                    .then(() => {
                        this.shelf.name = this.updateShelfForm.name;
                        this.shelf.description = this.updateShelfForm.description;
                        $('#modal-update-shelf').modal('hide');
                    })
            },

            /**
             * Delete the specified shelf.
             */
            deleteShelf() {
                App.delete(`/shelves/${this.shelf.id}`, this.deleteShelfForm)
                    .then(() => {
                        // redirect back to the profile page
                        console.log("success");
                        window.location.replace(`/@${this.user.username}`);
                    });
            },

        },

        computed: {
            profileUrl: function () {
                return '/@' + this.user.username;
            },

            canEditOrDelete() {
                return App.userId === this.user.id;
            }
        },
    }
</script>

<style lang="sass">
    .shelf-page-header {
        background-color: #F5F5F5
    }

    .shelf-header-user {
        margin-top: 0px;
        color: #072B54;
    }

    .profile-header-bio {
        color: lighten(#072B54, 5%);
    }

    .profile-name {
        font-size: 14px;
    }

    .small-profile-photo {
        height: 35px !important;
        width: 35px !important;
    }

    .books-count {
        color: black !important;
    }

    .resp-sharing-button__link,
    .resp-sharing-button__icon {
      display: inline-block
    }

    .resp-sharing-button__link {
      text-decoration: none;
      color: #fff;
      margin: 0.5em
    }

    .resp-sharing-button {
      border-radius: 5px;
      transition: 25ms ease-out;
      padding: 0.5em 0.75em;
      font-family: Helvetica Neue,Helvetica,Arial,sans-serif
    }

    .resp-sharing-button__icon svg {
      width: 1em;
      height: 1em
    }

    .resp-sharing-button span {
      padding-left: 0.4em
    }

    /* Non solid icons get a stroke */
    .resp-sharing-button__icon {
      stroke: #fff;
      fill: none
    }

    /* Solid icons get a fill */
    .resp-sharing-button__icon--solid,
    .resp-sharing-button__icon--solidcircle {
      fill: #fff;
      stroke: none
    }

    .resp-sharing-button--twitter {
      background-color: #55acee
    }

    .resp-sharing-button--twitter:hover {
      background-color: #2795e9
    }

    .resp-sharing-button--facebook {
      background-color: #3b5998
    }

    .resp-sharing-button--facebook:hover {
      background-color: #2d4373
    }

    .resp-sharing-button--facebook {
      background-color: #3b5998;
      border-color: #3b5998;
    }

    .resp-sharing-button--facebook:hover,
    .resp-sharing-button--facebook:active {
      background-color: #2d4373;
      border-color: #2d4373;
    }

    .resp-sharing-button--twitter {
      background-color: #55acee;
      border-color: #55acee;
    }

    .resp-sharing-button--twitter:hover,
    .resp-sharing-button--twitter:active {
      background-color: #2795e9;
      border-color: #2795e9;
    }

</style>
